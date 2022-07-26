<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_*'])->only('index');
        $this->middleware(['permission:users_create'])->only(['create', 'store']);
        $this->middleware(['permission:users_update'])->only(['edit', 'update', 'activation']);
        $this->middleware(['permission:users_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = User::with('roles')
            ->whereRoleIs('admin')
            ->whenSelected($request)
            ->latest()
            ->get();

        $roles = Role::whereRoleIsNot(['admin', 'super_admin', 'student', 'teacher'])->get();

        return view('admin.users.admins.index', [
            'admins' => $admins,
            'roles' => $roles
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereRoleIsNot(['admin', 'super_admin', 'student', 'teacher'])->get();

        return view('admin.users.admins.create', ['roles' => $roles]);
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        // get validated data
        $validated = $request->validated();
        $username = '@' . Str::before($validated['email'], '@') . '_' . Str::random(4);

        //create admin
        $admin = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'address' => $validated['address'],
            'activation'   => $validated['activation'],
            'username'  => $username
        ]);

        $admin->attachRoles(['admin', $validated['role']]);

        // put the profile
        if ($request->hasFile('profile'))
            $admin->updateProfilePhoto($request->file('profile'));

        // redirect
        return redirect()->back()->with('success', 'Create admin successfully');
    } //-- end store()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $roles = Role::with('permissions')
            ->whereRoleIsNot(['admin', 'super_admin', 'student', 'teacher'])
            ->get();


        $admin = User::with('roles')
            ->whereRoleIs('admin')
            ->where('username', $username)
            ->first();

        return view('admin.users.admins.edit', [
            'admin' => $admin,
            'roles' => $roles
        ]);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        // validated data
        $validated = $request->validated();

        // check the email to change the username
        $email = $admin->email;
        $username = $admin->username;

        if ($email != $validated['email'])
            $username = '@' . Str::before($validated['email'], '@') . '_' . Str::random(4);

        // check if there is photo
        if ($request->hasFile('profile'))
            $admin->updateProfilePhoto($request->file('profile'));


        // update
        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'activation'   => $validated['activation'],
            'username'  => $username

        ]);

        // syncPermissions for student
        $admin->syncRoles(['admin' , $validated['role']]);

        // redirect
        return redirect()->route('admins.users.admins.edit', $admin)->with('success', 'Update admin successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        // delete the photo
        $admin->deleteProfilePhoto();

        // delete the tokens
        $admin->tokens->each->delete();

        // delete the admin
        $del = $admin->delete();

        return $del ? response()->json(['status' => 'success', 'msg' => 'The admin was successfully deleted!'])
        : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } // end destroy()

    // delete thenot selected students
    public function destroySelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        $students = User::whereIn('id', $ids)->get();
        $students->each->deleteProfilePhoto();
        $students->each->tokens->each->delete();
        $students->each->delete();
        return response()->json(['status' => 'success', 'msg' => 'The selected students was successfully deleted!']);
    } //--end destroySelected()

    // make the admin active or not active
    public function activation(User $admin)
    {
        $response = $admin->activation ? $admin->update(['activation' => 0]) : $admin->update(['activation' => 1]);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for admin!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()


    // get the permissions for the selected role
    public function permissions(Role $role)
    {
        $permissions = $role->permissions;
        return view('admin.users.admins._permissions', [
            'permissions' => $permissions,
        ]);
    } //-- end permissions()
}//-- end AdminController

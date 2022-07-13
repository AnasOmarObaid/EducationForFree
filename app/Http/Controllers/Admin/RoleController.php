<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:roles_*'])->only('index');
        $this->middleware(['permission:roles_create'])->only(['create', 'store']);
        $this->middleware(['permission:roles_update'])->only(['edit', 'update']);
        $this->middleware(['permission:roles_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::with('permissions')
            ->whereRoleIsNot(['super_admin', 'admin', 'teacher', 'student'])
            ->whenSearch($request->search)
            ->withCount('users')
            ->latest()
            ->paginate(15);

        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    } //-- end of index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    } //-- end of create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {

        // get the only validated input
        $validated = $request->validated();

        // create roles
        $role = Role::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'display_name' => ucwords(Str::replace('_', ' ', Str::ucfirst($validated['name'])))
        ]);

        // attach Permissions
        $role->attachPermissions($validated['permissions']);

        // redirect
        return redirect()->route('admins.roles.create')->with('success', 'Create role successfully');
    } //-- end of store()


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return in_array($role->name, ['super_admin', 'admin', 'teacher', 'student'])
            ? abort(404) :
            view('admin.roles.edit', compact('role'));
    } //-- end of method edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $updateRoleRequest, Role $role)
    {
        // get the validated input
        $validated = $updateRoleRequest->validated();

        // update the role
        $role->update([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        //syncPermissions to the role
        $role->syncPermissions($validated['permissions']);

        // redirect
        return redirect()->route('admins.roles.edit', $role)->with('success', 'Update role successfully');
    } //-- end of method update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return $role ?  response()->json(['status' => 'success', 'msg' => 'The role was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'Some error occurred, try agin'], 404);
    } //-- end of method destroy


    public function destroySelected(Request $request)
    {
        $ids = $request->get('ids');
        Role::whereIn('id', explode(',', $ids))->delete();
        return response()->json(['status' => 'success', 'msg' => 'The selected roles was successfully deleted!']);
    } //-- end of method destroySelected
}//-- end role controller

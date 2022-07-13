<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = User::with('permissions')
            ->whereRoleIs(['teacher'])
            ->whenSelected($request)
            ->latest()
            ->get();

        return view('admin.users.teachers.index', [
            'teachers' => $teachers,
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.teachers.create');
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {

        // get validated data
        $validated = $request->validated();
        $username = '@' . Str::before($validated['email'], '@') . '_' . Str::random(4);

        //create teacher
        $teacher = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'address' => $validated['address'],
            'activation'   => $validated['activation'],
            'username'  => $username
        ]);


        // attach role for this student
        $teacher->attachRole('teacher');

        // attachPermissions for this user
        $teacher->attachPermissions($validated['permissions']);

        // put the profile
        if ($request->hasFile('profile'))
            $teacher->updateProfilePhoto($request->file('profile'));

        // redirect
        return redirect()->back()->with('success', 'Create teacher successfully');
    } //-- end store()


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $teacher = User::with('permissions')
            ->whereRoleIs('teacher')
            ->where('username', $username)
            ->first();

        return $teacher ? view('admin.users.teachers.edit', ['teacher' => $teacher]) : abort(404);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, User $teacher)
    {
        // validated data
        $validated = $request->validated();

        // check the email to change the username
        $email = $teacher->email;
        $username = $teacher->username;

        if ($email != $validated['email'])
            $username = '@' . Str::before($validated['email'], '@') . '_' . Str::random(4);


        // check if there is photo
        if ($request->hasFile('profile'))
            $teacher->updateProfilePhoto($request->file('profile'));

        // update
        $teacher->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'activation'   => $validated['activation'],
            'username'  => $username

        ]);

        // syncPermissions for student
        $teacher->syncPermissions($validated['permissions']);

        // redirect
        return redirect()->route('admins.users.teachers.edit', $teacher)->with('success', 'Update teacher successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        // delete the photo
        $teacher->deleteProfilePhoto();

        // delete the tokens
        $teacher->tokens->each->delete();

        // delete the teacher
        $teacher->delete();
    }//-- end delete()

    // delete the selected teachers
    public function destroySelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        $teachers = User::whereIn('id', $ids)->get();
        $teachers->each->deleteProfilePhoto();
        $teachers->each->tokens->each->delete();
        $teachers->each->delete();
        return response()->json(['status' => 'success', 'msg' => 'The selected teachers was successfully deleted!']);
    } //-- end destroySelected()
}//-- end teachers controller

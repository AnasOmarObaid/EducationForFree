<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Notifications\ControlRequestNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users_*'])->only('index');
        $this->middleware(['permission:users_create'])->only(['create', 'store']);
        $this->middleware(['permission:users_update'])->only(['edit', 'update', 'activation', 'acceptControl']);
        $this->middleware(['permission:users_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $students = User::with('permissions')
            ->whereRoleIs(['student'])
            ->whenSelected($request)
            ->latest()
            ->get();

        return view('admin.users.students.index', [
            'students' => $students,
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.students.create');
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

        //create student
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'address' => $validated['address'],
            'activation'   => $validated['activation'],
            'username'  => $username
        ]);

        // attach role for this student
        $user->attachRole('student');

        // attachPermissions for this user
        $user->attachPermissions($validated['permissions']);

        // put the profile
        if ($request->hasFile('profile'))
            $user->updateProfilePhoto($request->file('profile'));

        // redirect
        return redirect()->route('admins.users.students.create')->with('success', 'Create student successfully');
    } //-- end store()


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $student = User::with('permissions')
            ->whereRoleIs('Student')
            ->where('username', $username)
            ->first();

        return $student ? view('admin.users.students.edit', ['student' => $student]) : abort(404);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, User $student)
    {
        // validated data
        $validated = $request->validated();

        // check the email to change the username
        $email = $student->email;
        $username = $student->username;

        if ($email != $validated['email'])
            $username = '@' . Str::before($validated['email'], '@') . '_' . Str::random(4);

        // check if there is photo
        if ($request->hasFile('profile'))
            $student->updateProfilePhoto($request->file('profile'));

        // update
        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'activation'   => $validated['activation'],
            'username'  => $username

        ]);

        // syncPermissions for student
        $student->syncPermissions($validated['permissions']);

        // redirect
        return redirect()->route('admins.users.students.edit', $student)->with('success', 'Update student successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        // delete the photo
        $student->deleteProfilePhoto();

        // delete the tokens
        $student->tokens->each->delete();

        // delete the student
        $del = $student->delete();

        return $del ? response()->json(['status' => 'success', 'msg' => 'The student was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end destroy()


    // delete the selected students
    public function destroySelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        $students = User::whereIn('id', $ids)->get();
        $students->each->deleteProfilePhoto();
        $students->each->tokens->each->delete();
        $students->each->delete();
        return response()->json(['status' => 'success', 'msg' => 'The selected students was successfully deleted!']);
    } //-- end destroySelected()


    // make the students active or not active
    public function activation(User $student)
    {
        $response = $student->activation ? $student->update(['activation' => 0]) : $student->update(['activation' => 1]);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for student!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()

    // accept control to be teacher or not for this student
    public function acceptControl(Request $request, User $student)
    {
        // know what the control is
        switch ($request->input('accept', 1)):
            case 1:
                return $this->acceptRequest($student);
                break;
            default:
                return $this->rejectRequest($student);
        endswitch;
    } //-- end acceptControl()

    // accept the request for this student
    public function acceptRequest(User $student)
    {
        // oky, this student become teacher
        $student->update([
            'request_teacher' => 1
        ]);

        $student->detachRole('student');
        $student->attachRole('teacher');

        // send notify for this student to know him he has accepted to become teacher
        if (setting('system_notification'))
            $student->notify(new ControlRequestNotify('congratulations :) your request has been accepted, click on the button below to get started', $student->name));

        // return json response
        return response()->json(['status' => 'success', 'msg' => 'The request was successfully accepted!']);
    } //-- end acceptRequest()

    // reject the request for this student
    public function rejectRequest(User $student)
    {
        $student->update([
            'request_teacher' => 0
        ]);

        // send notify for this student to know him he has reject the request to become teacher
        if (setting('system_notification'))
            $student->notify(new ControlRequestNotify('Unfortunately ): your request has reject, read more about be constructor to accepted the request', $student->name));

        return response()->json(['status' => 'success', 'msg' => 'The request was rejected!']);
    } //-- end rejectRequest()
}

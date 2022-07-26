<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Notifications\ControlRequestNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_*'])->only('index');
        $this->middleware(['permission:users_create'])->only(['create', 'store']);
        $this->middleware(['permission:users_update'])->only(['edit', 'update', 'activation', 'rejectRequest']);
        $this->middleware(['permission:users_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor


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
            ->withCount('posts')
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
        $del = $teacher->delete();

        return $del ? response()->json(['status' => 'success', 'msg' => 'The teacher was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end delete()

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


    // reject the request for this student
    public function rejectRequest(User $teacher)
    {
        //update the request teacher ==> 0
        $teacher->update(['request_teacher' => 0]);

        $teacher->syncRoles(['student']);

        // send notify for this student to know him he has reject the request to become teacher
        if (setting('system_notification'))
            $teacher->notify(new ControlRequestNotify('Unfortunately ): your not teacher in our platform, read more about be constructor to accepted the request', $teacher->name));

        return response()->json(['status' => 'success', 'msg' => 'The request was rejected!']);
    } //-- end rejectRequest()

    // make the students active or not active
    public function activation(User $teacher)
    {
        $response = $teacher->activation ? $teacher->update(['activation' => 0]) : $teacher->update(['activation' => 1]);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for teacher!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()

}//-- end teachers controller

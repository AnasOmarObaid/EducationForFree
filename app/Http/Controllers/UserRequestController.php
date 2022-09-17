<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function requestTeacher()
    {
        $user = auth()->user();

        $user->update([
            'request_teacher' => 1
        ]);

        // syncRoles for this user to become teacher
        $user->syncRoles(['student']);

        return redirect()->back();
    } //-- end of requestTeacher
}//-- end of class UserRequestController

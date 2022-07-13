<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    } //-- end index function

    public function store(Request $request)
    {
        setting($request->all())->save();

        // redirect
        return redirect()->route('admins.settings.index')->with('success', 'Save setting successfully');
    } //-- end store function
}//-- end of class SettingController

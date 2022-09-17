<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function store(Request $request){
        Question::create([
            'name' => $request->name,
            'email' => $request->email,
            'question' => $request->question
        ]);

        return redirect()->back();
    }//-- end of store
}//-- end of class SupportController

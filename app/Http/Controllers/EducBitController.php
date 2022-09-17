<?php

namespace App\Http\Controllers;

use App\Models\EducBit;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Http\Request;

class EducBitController extends Controller
{
    public function index()
    {

        $main_bit = EducBit
            ::limit(1)
            ->first();

        $recent_bit = EducBit
            ::limit(4)
            ->get();

        $pop_bit = EducBit
            ::limit(6)
            ->get();

        $bits = EducBit::limit(10)->get();

        return view('pages.bits.index', [
            'main_bit' => $main_bit,
            'recent_bit' => $recent_bit,
            'pop_bit' => $pop_bit,
            'bits' => $bits
        ]);
    } //-- end index


    /**
     * show
     *
     * @param  mixed $user
     * @param  mixed $episode
     * @return void
     */
    public function show(User $user, EducBit $bit)
    {

        return view('pages.bits.show',[
            'user' => $user,
            'bit' => $bit
        ]);
    } //-- end show
}//-- end of class________________________________________________________________

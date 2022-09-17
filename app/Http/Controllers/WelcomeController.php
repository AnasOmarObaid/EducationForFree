<?php

namespace App\Http\Controllers;

use App\Models\EducBit;
use App\Models\PlaylistCategory;
use App\Models\Series;
use App\Models\Topic;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke(Request $request){

        $categories = PlaylistCategory
        ::latest()
        ->get();

        $bits = EducBit
        ::latest()
        ->get();


        $serieses = Series::with(['topic'])
        ->whenSelected($request)
        ->orderBy('id', 'desc')
        ->limit(2)
        ->get();

        $topics = Topic
        ::withCount('series')
        ->orderBy('id', 'desc')
        ->get();

        return view('welcome', [
            'categories' => $categories,
            'bits' => $bits,
            'serieses' => $serieses,
            'topics' => $topics
        ]);
    }//-- end of method __invoke
}//-- end of class WelcomeController

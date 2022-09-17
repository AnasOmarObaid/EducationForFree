<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Post;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::with(['posts'])
        ->get();

        $students = User::with('permissions')
            ->whereRoleIs(['student'])
            ->limit(8)
            ->latest()
            ->get();

        $posts = Post::get();

        $series = Series::get();

        $episodes = Episode::get();

        return view('admin.welcome', [
            'users' => $users,
            'posts' => $posts,
            'series' => $series,
            'episodes' => $episodes,
            'students' =>$students
        ]);
    } //-- end of method __invoke
}//-- end class WelcomeController

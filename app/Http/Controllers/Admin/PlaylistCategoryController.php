<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlaylistCategory;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:playlist-categories_*'])->only(['index', 'show']);
        $this->middleware(['permission:playlist-categories_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = PlaylistCategory::with(['user'])
            ->whenSelected($request)
            ->latest()
            ->get();

        $users = User::whereHas('playlistCategories')->get();

        return view('admin.playlist-categories.index', [
            'categories' => $categories,
            'users' => $users
        ]);
    }//-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlaylistCategory  $playlistCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PlaylistCategory $playlistCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlaylistCategory  $playlistCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PlaylistCategory $playlistCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlaylistCategory  $playlistCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlaylistCategory $playlistCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlaylistCategory  $playlistCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaylistCategory $playlistCategory)
    {
        //
    }
}

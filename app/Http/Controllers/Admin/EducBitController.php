<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\StreamEpisode;
use App\Models\EducBit;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Http\Request;

class EducBitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bits = EducBit::with(['user', 'category', 'episode'])
            ->latest()
            ->get();

        $users = User::whereHas('educBits')->get();

        return view('admin.educ-bits.index', [
            'bits' => $bits,
            'users' => $users
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create educ_bits
        //$episode = Episode::create();

        return view('admin.educ-bits.create');
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Episode::findOrFail($id)
        ->percent;

    } //-- end show()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EducBit  $educBit
     * @return \Illuminate\Http\Response
     */
    public function edit(EducBit $educBit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducBit  $educBit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducBit $educBit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducBit  $educBit
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducBit $educBit)
    {
        //
    }

    /**
     * createEmptyEpisode
     *
     * @return void
     */
    public function createEmptyEpisode()
    {
        return Episode::create()->id;
    } //-- end createEmptyEpisode


    public function uploadEpisode(Request $request)
    {

        // find the episode by given id
        $episode = Episode::findOrFail($request->id);

        // update the episode
        $episode->update([
            'path' => $request->file('episode')->store('episodes', 'public')
        ]);

        // call stream episode jop
        $this->dispatch(new StreamEpisode($episode));

        // return the episode
        return $episode;
    } //-- end uploadEpisode
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\StreamEpisode;
use App\Models\EducBit;
use App\Models\Episode;
use App\Models\PlaylistCategory;
use App\Models\User;
use App\Notifications\SendEducBitNotification;
use App\Notifications\SendUserEmailNotification;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class EducBitController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bits = EducBit::with(['user', 'category', 'episode'])
            ->whenSelected($request)
            ->latest()
            ->get();
        //dd($bits);
        $users = User::whereHas('educBits')->get();

        $categories = PlaylistCategory::active(1)->whereHas('educBits')->get();

        return view('admin.educ-bits.index', [
            'bits' => $bits,
            'users' => $users,
            'categories' => $categories
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PlaylistCategory::active(1)->get();
        return view('admin.educ-bits.create', ['categories' => $categories]);
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // create image
        $image_id = $this->storeImage($request->poster, 'educBit-poster');

        // get the episode and update the data
        $episode = Episode::find($request->episode_id);

        $episode->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => get_class(new EducBit),
            'learns' => $request->learns
        ]);

        // create educ bits
        $bit = EducBit::create([
            'user_id' => auth()->user()->id,
            'playlist_categories_id' => $request->playlist_category,
            'episode_id' => $request->episode_id,
            'image_id' => $image_id
        ]);

        // send notification
        $users = User::where('id', '!=', auth()->id())->get();

        if (setting('system_notification'))
            $users->each->notify(new SendEducBitNotification('there is new educ bit from ' . $bit->user->username . ' is published: ' . route('admins.educ-bits.index'), $bit));

        // return
        return redirect()->back()->with('success', 'Create EducBits successfully');
    } //-- end store()

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
    public function edit(EducBit $bit)
    {
        $categories = PlaylistCategory::active(1)->get();
        return view('admin.educ-bits.edit', [
            'bit' => $bit,
            'categories' => $categories
        ]);
    } //-- end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducBit  $educBit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducBit $bit)
    {
        // check if the poster is change or not
        // update the episode
        $image_id = $bit->poster->id;

        if ($request->hasFile('poster'))
            $image_id = $this->updateImage($request->file('poster'), $bit->poster, $bit->poster->path, 'educBit-poster');

        $bit->episode->update([
            'title' => $request->title,
            'description' => $request->description,
            'learns' => $request->learns,
        ]);

        // update the playlist category id
        $bit->update([
            'playlist_categories_id' => $request->playlist_category,
            'image_id' => $image_id,
        ]);

        // redirect
        return redirect()->route('admins.educ-bits.edit', $bit->id)->with('success', 'Update educ bits successfully');
    } //-- edn update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducBit  $educBit
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducBit $bit)
    {
        // delete the poster
        $this->checkAndDelete($bit->poster->path, 'educBit-poster/default.png', $bit->poster);

        // delete the video
        Storage::disk('public')->delete($bit->poster->path);

        // delete the encoding video
        Storage::disk('public')->deleteDirectory('encoding\episodes\\' . $bit->episode->id);

        // delete the comments for this post
        $bit->episode->delete();

        // delete the post
        $response = $bit->delete();

        return $response ? response()->json(['status' => 'success', 'msg' => 'The educ bit was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end delete

    /**
     * createEmptyEpisode
     *
     * @return void
     */
    public function createEmptyEpisode()
    {
        return Episode::create()->id;
    } //-- end createEmptyEpisode


    /**
     * uploadEpisode
     *
     * @param  mixed $request
     * @return void
     */
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

    // make the admin active or not active
    public function activation(EducBit $bit)
    {
        $response = $bit->activation ? $bit->update(['activation' => 0]) : $bit->update(['activation' => 1]);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for this educ bit!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()
}

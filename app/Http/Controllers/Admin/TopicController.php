<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\PlaylistCategory;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;

class TopicController extends Controller
{

    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = Topic::with(['category', 'poster', 'user', 'series'])
            ->whenSelected($request)
            ->withCount('series')
            ->orderBy('id', 'desc')
            ->get();

        $users = User::whereHas('topics')->get();

        $categories = PlaylistCategory::whereHas('topics')->get();

        return view('admin.topics.index', [
            'topics' => $topics,
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
        $categories  = PlaylistCategory::active(1)->get();

        return view('admin.topics.create', [
            'categories' => $categories
        ]);
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicRequest $request)
    {
        // validated the request
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;

        // upload the poster for this post and return the id of the image
        $validated['image_id'] = $this->storeImage($request->file('poster'), 'topics');

        // create the topic
        Topic::create([
            'name' => $validated['name'],
            'image_id' => $validated['image_id'],
            'user_id' => $validated['user_id'],
            'playlist_category_id' => $validated['playlist_category_id'],
            'activation'   => $validated['activation'],
        ]);

        // return
        return redirect()->back()->with('success', 'Create topic successfully');
    } //-- end store()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $categories = PlaylistCategory::active(1)->get();

        return view('admin.topics.edit', [
            'topic' => $topic,
            'categories' => $categories
        ]);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        // validated the request
        $validated = $request->validated();
        $validated['image_id'] = $topic->poster->id;
        // check if there is update for image or not
        if ($request->hasFile('poster'))
            $validated['image_id'] = $this->updateImage($request->file('poster'), $topic->poster, $topic->poster->path, 'topics');

        // update the topic
        $topic->update([
            'name' => $validated['name'],
            'image_id' => $validated['image_id'],
            'playlist_category_id' => $validated['playlist_category_id'],
            'activation'   => $validated['activation'],
        ]);

        // return
        return redirect()->route('admins.topics.edit', $topic)->with('success', 'update post successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //delete the poster for this topic
        $this->checkAndDelete($topic->poster->path, 'topics/default.png', $topic->poster);

        // delete the topic
        $response = $topic->delete();

        return $response ? response()->json(['status' => 'success', 'msg' => 'The topic was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end of delete


    /**
     * activation
     *
     * @param  mixed $topic
     * @return void
     */
    public function activation(Topic $topic)
    {
        $response = $topic->activation ? $topic->update(['activation' => 0]) : $topic->update(['activation' => 1]);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for this topic!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()

}

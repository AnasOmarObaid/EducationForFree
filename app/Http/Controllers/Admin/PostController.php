<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Notifications\SendPostNotification;
use App\Notifications\SendUserEmailNotification;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;

class PostController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware(['permission:posts_*'])->only('index');
        $this->middleware(['permission:posts_create'])->only(['create', 'store', 'activation']);
        $this->middleware(['permission:posts_update'])->only(['edit', 'update', 'activation']);
        $this->middleware(['permission:posts_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::has('posts')->get();
        $categories = PostCategory::has('posts')->get();

        $posts = Post::with(['author', 'category', 'comments', 'poster'])
            ->whenSelected($request)
            ->orderBy('id', 'desc')
            ->withCount('comments')
            ->get();

        return view('admin.posts.index', [
            'posts' => $posts,
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
        $categories = PostCategory::active(1)
            ->latest()
            ->get();

        return view('admin.posts.create', [
            'categories' => $categories
        ]);
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // validated the request
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;

        // upload the poster for this post and return the id of the image
        $validated['image_id'] = $this->storeImage($validated['image'], 'posts');

        // create post
        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'activation' => $validated['activation'],
            'user_id' => auth()->user()->id,
            'image_id'  => $validated['image_id'],
            'post_category_id'  => $validated['post_category_id'],
        ]);

        // send notify for all users about this post
        $users = User::where('id', '!=', auth()->id())->get();
        $user = User::where('id', '1')->first();

        
        // notify
        if (setting('system_notification'))
            $users->each->notify(new SendPostNotification($post));

        // return
        return redirect()->back()->with('success', 'Create post successfully');
    } //-- end store()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = PostCategory::active(1)
            ->latest()
            ->get();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //validated request
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $validated['image_id'] = $post->poster->id;

        // change the image
        if ($request->hasFile('image'))
            $validated['image_id'] = $this->updateImage($request->file('image'), $post->poster, $post->poster->path, 'posts');

        // update the post
        $post->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'activation' => $validated['activation'],
            'user_id' => auth()->user()->id,
            'image_id'  => $validated['image_id'],
            'post_category_id'  => $validated['post_category_id'],
        ]);

        // return
        return redirect()->route('admins.posts.edit', $post)->with('success', 'update post successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->checkAndDelete($post->poster->path, 'posts/default.png', $post->poster);

        // delete the comments for this post
        $post->comments->each->delete();

        // delete the post
        $response = $post->delete();

        return $response ? response()->json(['status' => 'success', 'msg' => 'The post was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end destroy()

    // make the admin active or not active
    /**
     * activation
     *
     * @param  mixed $post
     * @return void
     */
    public function activation(Post $post)
    {
        $user = $post->author;

        $response = $post->activation ? $this->unActivePost($post, $user)
            : $this->activePost($post, $user);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for post!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()

    // un active post with notification
    /**
     * unActivePost
     *
     * @param  mixed $post
     * @param  mixed $user
     * @return void
     */
    public function unActivePost($post, $user)
    {
        // update the activation
        $response = $post->update(['activation' => 0]);

        // send notify for user
        if (setting('system_notification'))
            $user->notify(new SendUserEmailNotification('the post title ' . $post->title . ' has blocked by admins contact with us to know more', $user));

        return $response;
    } //-- end unActivePost()

    //active post with notification
    /**
     * activePost
     *
     * @param  mixed $post
     * @param  mixed $user
     * @return void
     */
    public function activePost($post, $user)
    {
        // activation the post
        $response = $post->update(['activation' => 1]);

        // send notify for user
        if (setting('system_notification'))
            $user->notify(new SendUserEmailNotification('the post title ' . $post->title . ' has un blocked any more :)', $user));

        return $response;
    } //-- end activePost()
}//-- end post controller

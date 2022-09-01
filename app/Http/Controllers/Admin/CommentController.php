<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:comments_*'])->only(['index', 'show']);
        $this->middleware(['permission:comments_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::has('comments')->get();

        $comments = Comment::with(['user', 'likes', 'replays'])
            ->whenSelected($request)
            ->latest()
            ->withCount('likes')
            ->get();

        return view('admin.comments.index', [
            'comments' => $comments,
            'users' => $users
        ]);

    } //-- end index()


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $user = User::where('id', $comment->user->id)->first();
        //$comment->with('replays')->find($comment->id)->get();
        //dd($comment->replays);

        return view('admin.comments._show', [
            'comment' => $comment,
            'user' => $user
        ]);
    } //-- end show()


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $del = $comment->delete();

        return $del ? response()->json(['status' => 'success', 'msg' => 'The comment was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end destroy()


    // delete the selected students
    public function destroySelected(Request $request)
    {

        // explode the ids
        $ids = explode(',', $request->ids);

        // get the questions
        $comments = Comment::whereIn('id', $ids)->get();

        //delete the questions
        $comments->each->delete();

        // return the json response
        return response()->json(['status' => 'success', 'msg' => 'The selected comments was successfully deleted!']);
    } //--end destroySelected()
}//-- end class

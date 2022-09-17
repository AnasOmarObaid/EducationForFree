<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\Like;
use App\Models\Post;
use App\Models\Replay;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * storePostComment
     *
     * @param  mixed $request
     * @param  mixed $post_id
     * @return void
     */
    public function storePostComment(Request $request, $post_id)
    {

        // create comment
        $comment =  Comment::create([
            'body' => $request->body,
            'parent_id' => $post_id,
            'model' => get_class(new Post),
            'user_id' => $request->user_id,
        ]);

        return view('pages.posts.comments', [
            'comment' => $comment,
        ]);
    } //-- end of storePostComment


    /**
     * storeEpisodeComment
     *
     * @param  mixed $request
     * @param  mixed $episode
     * @return void
     */
    public function storeEpisodeComment(Request $request, Episode $episode)
    {
        // create comment
        $comment =  Comment::create([
            'body' => $request->body,
            'parent_id' => $episode->id,
            'model' => get_class(new Episode),
            'user_id' => $request->user_id,
        ]);

        return view('pages.posts.comments', [
            'comment' => $comment,
        ]);
    } //-- end of storePostComment


    /**
     * destroyPostComment
     *
     * @param  mixed $comment
     * @return void
     */
    public function destroyComment(Comment $comment)
    {

        return $comment->delete();
    } //-- end of destroyPostComment


    public function updateComment(Comment $comment, Request $request)
    {
        $comment->update([
            'body' => $request->body
        ]);

        return $request->body;
    } //-- end of updateComment


    public function likeComment(Comment $comment)
    {

        if (in_array(auth()->user()->id, $comment->likes->pluck('user_id')->toArray())) {
            like::where('user_id', auth()->user()->id)
                ->where('comment_id', $comment->id)
                ->delete();
        } else {
            Like::create([
                'user_id' => auth()->user()->id,
                'comment_id' => $comment->id
            ]);
        }
    } //-- end of like


    public function commentReplay(Comment $comment, Request $request)
    {
        Replay::create([
            'body' => $request->body,
            'comment_id' => $comment->id,
            'user_id' => auth()->user()->id
        ]);
    } //-- end of commentReplay
}//-- end of class CommentController

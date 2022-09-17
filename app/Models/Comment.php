<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use App\Models\Like;

class Comment extends Model
{
    protected $fillable = ['body', 'parent_id', 'model', 'user_id'];
    protected $with = ['replays', 'user'];

    //--------------------- scope --------------------
    public function scopeWhenSelected($query, $request)
    {
        return $query->when($request->usernames, function ($quer) use ($request) {
            return $quer->whereHas('user', function ($que) use ($request) {
                return $que->whereIn('username', $request->usernames);
            });
        })
            ->when($request->model, function ($qu) use ($request) {
                return $qu->where('model', $request->model);
            });
    }


    //--------------------- relationship --------------------

    /**
     * post relationship
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'parent_id')->where('model', get_class(new Post));
    } //-- end post


    /**
     * episode
     *
     * @return void
     */
    public function episode()
    {
        return $this->belongsTo(Episode::class, 'parent_id')->where('model', get_class(new Episode));
    } //-- end episode


    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } //-- end user relationship


    /**
     * likes
     *
     * @return void
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    } //-- end likes relationship


    /**
     * replays
     *
     * @return void
     */
    public function replays()
    {
        return $this->hasMany(Replay::class);
    } //-- end replays relationship
}

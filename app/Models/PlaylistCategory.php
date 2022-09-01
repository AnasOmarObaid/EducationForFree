<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaylistCategory extends Model
{
    protected $fillable = ['name', 'description', 'image', 'activation', 'user_id'];

    protected $table = 'playlist_categories';
    //------------------------------ helper
    public function imageUrl()
    {
        return asset('storage/' . $this->image);
    } //-- end imagePath()


    //--------------------- scope --------------------
    public function scopeWhenSelected($query, $request)
    {

        return $query->when($request->activation, function ($que) use ($request) {
            return $request->activation == 'false' ? $que->where('activation', 'false') : $que->where('activation', 1);
        })
            ->when($request->usernames, function ($qu) use ($request) {
                return $qu->whereHas('user', function ($user) use ($request) {
                    return $user->whereIn('username', $request->usernames);
                });
            });
    } //-- end scope when selected

    /**
     * scopeActive
     *
     * @param  mixed $query
     * @param  mixed $status
     * @return void
     */
    public function scopeActive($query, $status)
    {
        return $query->where('activation',  $status);
    } //-- end scope active


    // -----------------------------relationships
    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } //-- end user()
}//-- end of class PlaylistCategory

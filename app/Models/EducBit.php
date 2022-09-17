<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducBit extends Model
{
    protected $fillable = ['episode_id', 'user_id', 'image_id', 'playlist_categories_id', 'activation'];
    protected $table = 'educ_bits';
    protected $with = ['user', 'category', 'episode'];


    //---------------------------------------- helpers
    /**
     * getPosterUrl
     *
     * @return void
     */
    public function getPosterUrl()
    {
        return asset('storage/' . $this->poster->path);
    } //-- end getPosterUrl


    //---------------------------------------- relationship
    /**
     * poster
     *
     * @return void
     */
    public function poster()
    {
        return $this->belongsTo(Image::class, 'image_id');
    } //-- end poster relationship


    // ----------------------------------------scopes
    public function scopeWhenSelected($query, $request)
    {
        return $query->when($request->activation, function ($que) use ($request) {
            return $que->where('activation', $request->activation);
        })
            ->when($request->usernames, function ($qu) use ($request) {
                return $qu->whereHas('user', function ($user) use ($request) {
                    return $user->whereIn('username', $request->usernames);
                });
            })->when($request->categories, function ($q) use ($request) {
                return $q->whereHas('category', function ($category) use ($request) {
                    return $category->whereIn('name', $request->categories);
                });
            });
    } //-- end scope when selected

    // ----------------------------------------relationships
    /**
     * episode
     *
     * @return void
     */
    public function episode()
    {
        return $this->hasOne(Episode::class, 'id');
    } //-- end episode relationship

    /**
     * user
     *
     * @return void
     */

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    } //-- end user relationship


    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(PlaylistCategory::class, 'playlist_categories_id');
    } //-- end category relationship



}//-- end EducBit class

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    protected $fillable = ['name', 'user_id', 'image_id', 'playlist_category_id', 'activation'];
    protected $with = ['series'];


    //--------------------- attributes --------------------
    /**
     * Title
     *
     * @return Attribute
     */
    public function Name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::replace(' ', '-', $value)
        );
    } //-- end Name attributes


    //--------------------- helper --------------------
    /**
     * getPoster
     *
     * @return void
     */
    public function getPosterUrl()
    {
        return asset('storage/' . $this->poster->path);
    } //-- end getPoster


    public function getEpisodeCount()
    {
        $count = 0;

        foreach ($this->series as $series) {
            foreach ($series->sections->loadCount('episodes') as $section) {
                $count += $section->episodes_count;
            }
        }

        return $count;
    }

    //--------------------- scope --------------------
    /**
     * scopeWhenSelected
     *
     * @param  mixed $query
     * @param  mixed $request
     * @return void
     */
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
    } //-- end whenSelected --------------------


    // --------------------------- relationships

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(PlaylistCategory::class, 'playlist_category_id');
    }

    /**
     * poster
     *
     * @return void
     */
    public function poster()
    {
        return $this->belongsTo(Image::class, 'image_id');
    } //-- end poster

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    } //-- end user

    /**
     * series
     *
     * @return void
     */
    public function series()
    {
        return $this->hasMany(Series::class);
    } //-- end series ------------------------
}//-- end of class Topic

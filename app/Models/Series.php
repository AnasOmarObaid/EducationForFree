<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'topic_id', 'image_id', 'activation'];
    protected $with = ['sections'];

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


    /**
     * getEpisodeCount
     *
     * @return void
     */
    public function getEpisodeCount()
    {
        $count = 0;
        foreach ($this->sections->loadCount('episodes') as $section) {
            $count += $section->episodes_count;
        }

        return $count;
    } // --end getEpisodeCount


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
             })->when($request->topics, function ($q) use ($request) {
                 return $q->whereHas('topic', function ($topic) use ($request) {
                     return $topic->whereIn('name', $request->topics);
                 });
             });
     } //-- end scope when selected

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
     * topic
     *
     * @return void
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    } //-- end topic

    /**
     * sections
     *
     * @return void
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    } //-- end sections
}//-- end of class series

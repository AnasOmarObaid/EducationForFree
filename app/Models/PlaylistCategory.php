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

    /**
     * getEpisodeCount
     *
     * @return void
     */
    public function getEpisodeCount(){
        $count = 0;
        foreach($this->topics as $topic){
            foreach($topic->series as $series){
                $count += $series->getEpisodeCount();
            }
        }

        return $count;
    }

    /**
     * getSeriesCount
     *
     * @return void
     */
    public function getSeriesCount(){
        $count = 0;

        foreach($this->topics as $topic){
            $count += $topic->series->count();
        }

        return $count;
    }

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

    /**
     * educBits
     *
     * @return void
     */
    public function educBits()
    {
        return $this->hasMany(EducBit::class, 'id');
    } //-- end educ bits


    /**
     * topics
     *
     * @return void
     */
    public function topics()
    {
        return $this->hasMany(Topic::class, 'id');
    } //-- end function topics()

}//-- end of class PlaylistCategory

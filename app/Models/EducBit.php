<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducBit extends Model
{
    protected $fillable = ['episode_id', 'user_id', 'playlist-categories_id'];
    protected $table = 'educ_bits';

    // ----------------------------------------relationships
    /**
     * episode
     *
     * @return void
     */
    public function episode()
    {
        return $this->hasOne(Episode::class);
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

    public function category()
    {
        return $this->belongsTo(PlaylistCategory::class, 'playlist-categories_id');
    } //-- end category relationship
}//-- end EducBit class

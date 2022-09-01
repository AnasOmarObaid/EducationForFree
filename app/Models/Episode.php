<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Episode extends Model
{
    protected $fillable = ['title', 'path', 'image_id', 'description', 'learns', 'type', 'percent'];
    protected $table = 'episodes';

    //--------------------- attributes --------------------
    /**
     * Title
     *
     * @return Attribute
     */
    public function Title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::replace(' ', '-', $value)
        );
    } //-- end Name attributes


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

    /**
     * comments
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('model', get_class(new Episode));
    } //-- end comments

}//-- end episode

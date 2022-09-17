<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Episode extends Model
{
    protected $fillable = ['title', 'path', 'description', 'learns', 'type', 'parent_id', 'percent'];
    protected $table = 'episodes';

    protected $width = ['comments'];

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    protected $fillable = ['body', 'user_id', 'comment_id'];

    //protected $with = ['user', 'comment'];
    //--------------------- relationship
    /**
     * comment
     *
     * @return void
     */
    public function comment(){
        return $this->belongsTo(Comment::class);
    }//-- end comment()


    public function user(){
        return $this->belongsTo(User::class);
    }//-- end replay()
}//-- end Replay class

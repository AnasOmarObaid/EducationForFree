<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'comment_id'];

    //--------------------- relationships ---------
    /**
     * user relationship
     *
     * @return void
     */
    public function user(){
        return $this->belongsTo(User::class);
    }//--end user()


    /**
     * comment
     *
     * @return void
     */
    public function comment(){
        return $this->belongsTo(Comment::class);
    }//-- end comment()

}//-- end of class Like

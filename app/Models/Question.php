<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'question', 'answer', 'read_at'];

    protected $dates = ['read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];


    //----------- scope
    public function scopeWhereReadIs($query, $request)
    {
        return $query->when($request->read_at, function ($que) use ($request) {
            return $request->read_at == 1 ? $que->where('read_at', '!=', null) : $que->where('read_at', null);
        })
            ->when($request->is_answered, function ($qu) use ($request) {
                return $request->is_answered == 1 ? $qu->where('answer', '!=', null) : $qu->where('answer', null);
            });
    } //-- end scope whereReadIs

}//-- end question model

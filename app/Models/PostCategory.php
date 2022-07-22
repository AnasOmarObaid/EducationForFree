<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = ['name', 'description', 'activation', 'user_id'];


    //--------------------- attributes --------------------
    public function Name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower(str_replace(' ', '-', $value))
        );
    } //-- end Name attributes


    //--------------------- scope --------------------
    public function scopeWhenSelected($query, $request)
    {

        return $query->when($request->activation, function ($que) use ($request) {
            return $request->activation == 'false' ? $que->where('activation', 'false') : $que->where('activation', 1);
        })
            ->when($request->usernames, function ($qu) use ($request) {
                return $qu->whereHas('User', function ($user) use ($request) {
                    return $user->whereIn('username', $request->usernames);
                });
            });
    } //-- end scope when selected



    //--------------------- relationship --------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    } //-- end relationship
}//-- end class PostCategory

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{


    protected $fillable = ['title', 'body', 'activation', 'post_category_id', 'user_id', 'image_id'];

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

    //--------------------- helper --------------------
    /**
     * getPoster
     *
     * @return void
     */
    public function getPoster()
    {
        return asset('storage/' . $this->poster->path);
    } //-- end getPoster()


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
                return $qu->whereHas('author', function ($user) use ($request) {
                    return $user->whereIn('username', $request->usernames);
                });
            })->when($request->categories, function ($q) use ($request) {
                return $q->whereHas('category', function ($category) use ($request) {
                    return $category->whereIn('name', $request->categories);
                });
            });
    } //-- end whenSelected --------------------

    //--------------------- relationship --------------------
    /**
     * author
     *
     * @return void
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    } //-- end author

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    } //-- end category

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
     * comments
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('model', get_class(new Post));
    }//-- end comments()
}//-- end class Post

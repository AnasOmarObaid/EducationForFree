<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    //protected $with = 'permissions';
    protected $with = ['comments'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activation',
        'username',
        'address',
        'request_teacher'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    //-------------------- scopes--------------------
    public function scopeWhenSelected($query, $request)
    {
        return $query->when($request->activation, function ($que) use ($request) {
            return $que->where('activation', $request->activation);
        })
            ->when($request->permissions, function ($qu) use ($request) {
                return $qu->whereHas('permissions', function ($permissions) use ($request) {
                    return $permissions->whereIn('name', $request->permissions);
                });
            })

            ->when($request->roles, function ($qo) use ($request) {
                return $qo->whereHas('roles', function ($roles) use ($request) {
                    return $roles->whereIn('name', $request->roles);
                });
            })
            ->when($request->request_teacher, function ($q) use ($request) {
                return $q->where('request_teacher', $request->request_teacher);
            });
    } //-- end scope active


    //--------------------- relationship --------------------
    /**
     * postCategories
     *
     * @return void
     */
    public function postCategories()
    {
        return $this->hasMany(PostCategory::class);
    } // -- end postCategory()


    /**
     * playlistCategories
     *
     * @return void
     */
    public function playlistCategories()
    {
        return $this->hasMany(PlaylistCategory::class);
    } //-- end playlistCategories()
    /**
     * posts
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    } //-- end posts()

    /**
     * comments
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    } //-- end comments()

    /**
     * likes
     *
     * @return void
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    } //-- end likes()


    /**
     * replays
     *
     * @return void
     */
    public function replays()
    {
        return $this->hasMany(Replay::class);
    } //-- end replays()

    /**
     * educBits
     *
     * @return void
     */
    public function educBits()
    {
        return $this->hasMany(EducBit::class);
    } //-- end educBits()

    /**
     * topics
     *
     * @return void
     */
    public function topics(){
        return $this->hasMany(Topic::class);
    }

    /**
     * series
     *
     * @return void
     */
    public function series(){
        return $this->hasMany(Series::class);
    }//-- end series()
}

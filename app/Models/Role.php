<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Role extends LaratrustRole
{
    public $guarded = [];
    //protected $with = ['permissions'];

    //--------------------- attributes --------------------
    public function Name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower(str_replace(' ', '_', $value))
        );
    } //-- end Name attributes

    public function Created_at(): Attribute
    {
        return Attribute::make(get: fn ($value) => \Carbon\Carbon::parse($value)->format('d-m-Y'));
    } //-- end Name attributes

    //-------------------- scope --------------------
    public function scopeWhereRoleIs($query, $role_name)
    {
        return $query->whereIn('name', (array) $role_name);
    } //-- end scope where role $role->whereRoleIs()

    public function scopeWhereRoleIsNot($query, $role_name)
    {
        return $query->whereNotIn('name', (array) $role_name);
    } //-- end scope where role $role->whereRoleIsNot()

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($qu) use ($search) {
            return $qu->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhereHas('permissions', function ($q) use ($search) {
                    return $q->where('name', 'like', "%$search%");
                });
        });
    } //-- end scope when search Role::whenSearch()
}//-- end Role Model

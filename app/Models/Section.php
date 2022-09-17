<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'series_id'];
    protected $with = ['episodes'];

    //----------------- relationship

    /**
     * series
     *
     * @return void
     */
    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    } //-- end series

    /**
     * episodes
     *
     * @return void
     */
    public function episodes(){
        return $this->hasMany(Episode::class, 'parent_id')->where('type', get_class(new Section));
    }//-- end episodes

}//-- end of class Section

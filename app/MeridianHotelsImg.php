<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeridianHotelsImg extends Model
{

    use SoftDeletes;
    protected $table='meridian_hotels_img';
    public $primaryKey='id';
    public $timestamps=true;

    public function MeridianHotels()
    {
        return $this->belongsTo('App\MeridianHotels');
    }
    //
}

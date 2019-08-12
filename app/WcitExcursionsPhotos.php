<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WcitExcursionsPhotos extends Model
{
    use SoftDeletes;
    protected $table='wcit_excursions_photos';
    public $primaryKey='id';
    public $timestamps=true;

    public function WcitExcursions()
    {
        return $this->belongsTo('App\WcitExcursions');
    }
    //
}

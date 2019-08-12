<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WcitExcursions extends Model
{
   //
    use SoftDeletes;

    protected $table='wcit_excursions';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'group_price_amd', 'group_price_usd', 'group_price_eur', 'private_price_amd', 'private_price_usd', 'private_price_eur', 'name', 'main_photo_src', 'short_description', 'description',
    ];
    public function photos()
    {
        return $this->hasMany('App\WcitExcursionsPhotos');
    }
    public function includes()
    {
        return $this->hasMany('App\WcitExcursionsIncludes');
    }
}

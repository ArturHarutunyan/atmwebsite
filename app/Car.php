<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class Car extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='cars';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'make','model','color','year','seat_count','quality','is_leather','is_foldable',
        'fuel_type_id','volume','price_id','has_air_conditioning'
    ];
    public function car_images()
    {
        return $this->hasMany('App\CarImage');
    }
    public function fuel_type()
    {
        return $this->belongsTo('App\FuelType');
    }
    public function price()
    {
        return $this->belongsTo('App\Price');
    }
    public function car_model()
    {
        return $this->belongsTo('App\CarModel');
    }
}
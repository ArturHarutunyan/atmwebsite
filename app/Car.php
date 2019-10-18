<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class Car extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table = 'cars';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'model_id', 'color', 'year', 'seat_count', 'baggage_quantity', 'is_leather', 'is_foldable',
        'fuel_type_id', 'volume', 'price_id', 'has_air_conditioning', 'has_monitor'
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
        return $this->belongsTo('App\CarModel', 'model_id', 'id');
    }
    public function additional_services()
    {
        return $this->hasMany('App\AdditionalService');
    }
}

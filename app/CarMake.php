<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class CarMake extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='car_makes';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'name','is_featured'
    ];

    public function car_models()
    {
        return $this->hasMany('App\CarModel', 'make_id', 'id');
    }
}

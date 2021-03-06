<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class FuelType extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='fuel_types';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'name'
    ];
    public function cars()
    {
        return $this->hasMany('App\Car');
    }
}
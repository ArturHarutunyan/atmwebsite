<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class CarModel extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='car_models';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'make_id','name','is_custom'
    ];
    public function cars()
    {
        return $this->hasMany('App\Car','model_id','id');
    }
    public function car_make()
    {
        return $this->belongsTo('App\CarMake', 'make_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class CarImage extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='car_images';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'name','car_id'
    ];
    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}

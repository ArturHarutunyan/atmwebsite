<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class AdditionalService extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='additional_services';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'car_id','name'
    ];
    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}

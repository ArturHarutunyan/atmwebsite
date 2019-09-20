<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class AdditionalService extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='cars';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'car_id','name'
    ];
    public function price()
    {
        return $this->belongsTo('App\Price');
    }
}

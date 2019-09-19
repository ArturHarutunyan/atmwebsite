<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class CustomRoute extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='custom_routes';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'price_id','name','amount'
    ];

    public function price()
    {
        return $this->belongsTo('App\Price');
    }
}

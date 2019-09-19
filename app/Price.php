<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class Price extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='prices';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'customer_id','per_km','per_km_driver'
    ];
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function cars()
    {
        return $this->hasMany('App\Car');
    }
    public function routes()
    {
        return $this->belongsToMany('App\Route');
    }
    public function custom_routes()
    {
        return $this->hasMany('App\CustomRoute');
    }
}
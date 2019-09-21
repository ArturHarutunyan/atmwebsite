<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class Route extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='routes';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'name'
    ];
    public function prices()
    {
        return $this->belongsToMany('App\Price')->withPivot('amount');
    }
}
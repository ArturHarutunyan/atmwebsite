<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class WcitOrder extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='wcit_orders';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'day'
    ];
    public function wcit_orders()
    {
        return $this->hasMany('App\WcitOrder');
    }
    public function wcit_orders()
    {
        return $this->hasMany('App\WcitOrder');
    }
    public function wcit_orders()
    {
        return $this->hasMany('App\WcitOrder');
    }
}

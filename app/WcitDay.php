<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class WcitDay extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='wcit_days';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'date'
    ];
    public function wcit_orders()
    {
        return $this->hasMany('App\WcitOrder');
    }
}

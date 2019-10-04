<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class WcitCustomer extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='wcit_customers';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'name','surname','phone','email','organization','notes'
    ];
    public function wcit_orders()
    {
        return $this->hasMany('App\WcitOrder');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class Customer extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='customers';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'legal_name','phone','email','tin','notes','name','legal_address','business_address','directors_name'
    ];
    public function prices()
    {
        return $this->hasMany('App\Price');
    }
}

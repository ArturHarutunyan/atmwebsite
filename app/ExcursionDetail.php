<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class ExcursionDetail extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;

    protected $table='excursion_details';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'wcit_excursion_id','color'
    ];

    public function excursion_details()
    {
        return $this->belongsTo('App\WcitExcursions', 'wcit_excursion_detail','id');
    }
}

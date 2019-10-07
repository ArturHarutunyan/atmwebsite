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
        'wcit_excursion_id','wcit_customer_id','wcit_day_id','status',
        'guide_id','driver_id','price','tour_language_id',
        'people_count','excursion_type_id'
    ];
    public function wcit_excursion()
    {
        return $this->belongsTo('App\WcitExcursions', 'wcit_excursion_id','id');
    }
    public function wcit_customer()
    {
        return $this->belongsTo('App\WcitCustomer');
    }
    public function wcit_day()
    {
        return $this->belongsTo('App\WcitDay');
    }
    public function tour_language()
    {
        return $this->belongsTo('App\TourLanguage');
    }
}

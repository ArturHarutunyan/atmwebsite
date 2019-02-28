<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class Tour extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    use SoftDeletes;
    protected $table='tours';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'tour_image','start_price','currency_id','season_id','period_id','group_size_id', 'guaranteed', 'days_count','nights_count','hotel_id'
    ];
    public $translatedAttributes = ['name'];

    public function tour_types()
    {
        return $this->belongsToMany('App\TourType');
    }
    public function season()
    {
        return $this->belongsTo('App\TourSeason');
    }
    public function period()
    {
        return $this->belongsTo('App\TourPeriod');
    }
    public function group_size()
    {
        return $this->belongsTo('App\TourGroupSize');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }
    public function days()
    {
        return $this->hasMany('App\TourDay');
    }
}

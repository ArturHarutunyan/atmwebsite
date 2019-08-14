<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class TourDayImage extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='tour_day_images';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=['name','tour_day_id'];
    public function tour_day()
    {
        return $this->belongsTo('App\TourDay');
    }
}

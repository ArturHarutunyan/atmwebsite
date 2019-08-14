<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class TourDay extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    use SoftDeletes;
    protected $table='tour_days';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    protected $fillable=['day_number','tour_id'];
    public $translatedAttributes = ['text_content'];
    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }
    public function tour_day_images()
    {
        return $this->hasMany('App\TourDayImage');
    }
}

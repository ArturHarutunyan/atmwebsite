<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class TourPeriod extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    protected $table='tour_periods';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    use SoftDeletes;
    public $translatedAttributes = ['name'];
    protected $fillable=[];
    public function tours(){
        return $this->hasMany('App\Tour');
    }
}

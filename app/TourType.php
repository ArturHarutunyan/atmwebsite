<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class TourType extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    protected $table='tour_types';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[];
    public $translatedAttributes = ['name'];
    protected $dates=['deleted_at'];
    use SoftDeletes;
    public function tours()
    {
        return $this->belongsToMany('App\Tour');
    }
}
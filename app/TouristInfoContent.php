<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class TouristInfoContent extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    protected $table='tourist_info_contents';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[];
    public $translatedAttributes = ['visa_content','climate_content','currency_content','safety_content'];
}

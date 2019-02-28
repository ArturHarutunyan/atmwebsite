<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class HomePageContent extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    protected $table='home_page_contents';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[];
    public $translatedAttributes = ['who_we_are_content','the_best_tours_content','unique_services_content'];
}

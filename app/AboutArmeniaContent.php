<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class AboutArmeniaContent extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    protected $table='about_armenia_contents';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'history_image','religion_image'
    ];
    public $translatedAttributes = ['history_content','culture_content_one','culture_content_two',
        'religion_content','climate_content','winter_content','spring_content',
        'summer_content','autumn_content','first_reason_content','second_reason_content',
        'third_reason_content','fourth_reason_content','fifth_reason_content','climate_content_two'];
}

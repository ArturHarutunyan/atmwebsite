<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class Testimonial extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    use SoftDeletes;
    protected $table='testimonials';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'author_image','gender'
    ];
    public $translatedAttributes = ['author','text_content'];
}

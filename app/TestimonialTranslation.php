<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class TestimonialTranslation extends Model
{
    use Sluggable;
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    public $timestamps = true;
    protected $fillable=[
        'author','text_content'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'author'
            ]
        ];
    }
}

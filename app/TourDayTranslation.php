<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class TourDayTranslation extends Model
{
    use Sluggable;
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    public $timestamps = true;
    protected $fillable=[
        'text_content','slug'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'id'
            ]
        ];
    }
}

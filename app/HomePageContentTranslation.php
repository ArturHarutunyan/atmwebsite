<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class HomePageContentTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Sluggable;
    public $timestamps = true;
    protected $fillable=[
        'who_we_are_content','the_best_tours_content','unique_services_content'
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

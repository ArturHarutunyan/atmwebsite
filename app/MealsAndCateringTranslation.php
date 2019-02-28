<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class MealsAndCateringTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Sluggable;
    public $timestamps = true;
    protected $fillable=[
        'name','description','address'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}

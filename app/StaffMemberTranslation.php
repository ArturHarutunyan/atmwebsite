<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class StaffMemberTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Sluggable;
    public $timestamps = true;
    protected $fillable=[
        'name','surname','position','slug'
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

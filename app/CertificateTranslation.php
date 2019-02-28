<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class CertificateTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Sluggable;

    public $timestamps = true;
    protected $fillable=[
        'title','text_content','slug'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

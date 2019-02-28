<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class ProjectTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    public $timestamps = true;
    protected $fillable=[
        'name'
    ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class Currency extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $revisionCreationsEnabled = true;
    protected $table='currencies';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    use SoftDeletes;
    protected $fillable=[
        'name','rate','sign'
    ];
    public function tours(){
        return $this->hasMany('App\Tour');
    }
}

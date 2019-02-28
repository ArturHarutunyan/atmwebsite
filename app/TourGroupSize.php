<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class TourGroupSize extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='tour_group_sizes';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    use SoftDeletes;
    protected $fillable=[
        'size'
    ];
    public function tours(){
        return $this->hasMany('App\Tour');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class HotelCategory extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='hotel_categories';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    use SoftDeletes;
    protected $fillable=[
        'name'
    ];
    public function hotels(){
        return $this->hasMany('App\Hotel');
    }
}

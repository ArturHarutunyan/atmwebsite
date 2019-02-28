<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class Hotel extends Model
{
    use Translatable;
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $table='hotels';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    use SoftDeletes;
    public $translatedAttributes = ['name', 'address', 'description'];
    protected $fillable=[
        'is_in_yerevan','category_id','link'
    ];
    public function category()
    {
        return $this->belongsTo('App\HotelCategory');
    }
    public function tours()
    {
        return $this->hasMany('App\Tour');
    }
/*    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }*/
}
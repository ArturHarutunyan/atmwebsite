<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;

class MeridianHotels extends Model
{
    //
    use SoftDeletes;
    use Translatable;

    protected $table='meridian_hotels';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'name','address','price_sgl','price_dbl','max_qty','facilities_json',
    ];
    public $translatedAttributes = ['name','address','facilities_json'];
    public function imgs()
    {
        return $this->hasMany('App\MeridianHotelsImg');
    }

}

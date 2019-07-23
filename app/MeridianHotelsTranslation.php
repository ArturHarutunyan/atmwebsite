<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeridianHotelsTranslation extends Model
{
    public $timestamps = true;
    protected $fillable=[
        'name','address','facilities_json'
    ];

}

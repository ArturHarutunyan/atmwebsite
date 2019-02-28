<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class PageName extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    protected $revisionCreationsEnabled = true;
    protected $table='page_names';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    use SoftDeletes;
    protected $fillable=[
        'name'
    ];
    public function custom_meta_tags(){
        return $this->belongsToMany('App\CustomMetaTag');
    }
}

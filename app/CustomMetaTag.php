<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class CustomMetaTag extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use SoftDeletes;
    protected $revisionCreationsEnabled = true;
    protected $table='custom_meta_tags';
    public $primaryKey='id';
    public $timestamps=true;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'name','description','page_name'
    ];
    public function page_names(){
        return $this->belongsToMany('App\PageName');
    }
}

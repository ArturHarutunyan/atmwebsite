<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;

class ServicesContent extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    use Translatable;
    protected $table='services_contents';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[
        'for_fit_image','tour_id_one','tour_id_two'
    ];
    public $translatedAttributes = ['tour_packages_content','hotel_reservation_content','choose_hotel_content',
        'select_dates_content','welcome_to_armenia_content','transport_content','meals_content','excursions_content',
        'mice_content_one','mice_content_two','translation_content','translation_content',
        'equipment_content','for_fit_content'];
}

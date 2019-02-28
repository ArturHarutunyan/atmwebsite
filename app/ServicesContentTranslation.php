<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class ServicesContentTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    public $timestamps = true;
    protected $fillable=['tour_packages_content','hotel_reservation_content','choose_hotel_content',
        'select_dates_content','welcome_to_armenia_content','transport_content','meals_content','excursions_content',
        'mice_content_one','mice_content_two','translation_content','translation_content',
        'equipment_content','for_fit_content'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Fico7489\Laravel\RevisionableUpgrade\Traits\RevisionableUpgradeTrait;
class AboutContentTranslation extends Model
{
    use RevisionableTrait;
    use RevisionableUpgradeTrait;
    public $timestamps = true;
    protected $fillable=['company_content','our_projects_content','dmc_content',
        'excursion_content','logistics_content','special_events_content','for_partners_content',
        'login_password_content','your_account_content','special_content','why_me_first_title',
        'why_me_first_content','why_me_second_title','why_me_second_content','why_me_third_title',
        'why_me_third_content','why_me_fourth_title','why_me_fourth_content'
    ];
}

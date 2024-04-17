<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tests\Unit\VideoTest;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Video extends Model
{
    use HasFactory;
    use HasRoles;

    public static function testesBy()
    {
        return VideoTest::class;
    }

    protected $guarded = [];

    protected $dates = ['published_at'];

    public function getFormattedForHumansPublishedAtAttribute()
    {
        //Carbon::setLocale('ca');
        //dd($this->published_at->format('j \d\e F \d\e Y'));
        //dd($this->published_at->locale(config('app.locale')));
        dd(optional($this->published_at)->timestamp);
        if (!$this->published_at) return '';
        $locale_date = optional($this->published_at)->locale(config('app.locale'));
        return $locale_date->day . ' de ' . $locale_date->monthName . ' de ' . $locale_date->year;


    }

    public function getFormattedPublishedAtAttribute()
    {
        return optional($this->published_at)->diffForHumans(Carbon::now());

    }

    public function getPublishedTimesTampAtAttribute()
    {
        return optional($this->published_at)->timestamp;

    }
}

<?php

namespace ThachVd\LaravelSiteControllerApi\Models;

use Illuminate\Database\Eloquent\Model;

class TlLincolnHotel extends Model
{
    protected $table = 'tllincoln_hotels';
    protected $fillable = [
        'facility_id',
        'tllincoln_hotel_id',
        'tllincoln_hotel_name',
        'tllincoln_hotel_address',
        'tllincoln_hotel_phone',
    ];
}

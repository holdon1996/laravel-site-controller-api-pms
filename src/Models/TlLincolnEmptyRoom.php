<?php

namespace ThachVd\LaravelSiteControllerApi\Models;

use Illuminate\Database\Eloquent\Model;

class TlLincolnEmptyRoom extends Model
{
    protected $table = 'tllincoln_empty_rooms';
    protected $fillable = [
        'tllincoln_hotel_id',
        'tllincoln_roomtype_code',
        'tllincoln_sell_date',
        'tllincoln_room_empty',
        'tllincoln_flag',
        'tllincoln_updated_at',
        'tllincoln_sell_status',
    ];
    const DELETE_FLAG = 3;

    const CSV_ATTRIBUTE = [
        'TLLINCOLN_HOTEL_ID' => 0,
        'ROOM_TYPE_CODE'     => 1,
        'SELL_DATE'          => 2,
        'ROOM_EMPTY'         => 3,
        'FLAG'               => 4,
        'UPDATED_AT'         => 5,
        'SELL_STATUS'        => 6,
    ];
}

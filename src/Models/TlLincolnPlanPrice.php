<?php

namespace ThachVd\LaravelSiteControllerApi\Models;

use Illuminate\Database\Eloquent\Model;

class TlLincolnPlanPrice extends Model
{
    protected $table = 'tllincoln_plan_prices';
    protected $fillable = [
        'tlLincoln_hotel_id',
        'tllincoln_plan_id',
        'tllincoln_roomtype_code',
        'tllincoln_sell_date',
        'tllincoln_remaining_quantity',
        'tllincoln_sell_status',
        'tllincoln_price_one_adult',
        'tllincoln_price_two_adults',
        'tllincoln_price_three_adults',
        'tllincoln_price_four_adults',
        'tllincoln_price_five_adults',
        'tllincoln_price_six_adults',
        'tllincoln_price_seven_adults',
        'tllincoln_price_eight_adults',
        'tllincoln_price_night_adults',
        'tllincoln_price_for_ten_adults_or_more',
        'tllincoln_flag',
        'tllincoln_updated_at',
    ];

    const CSV_ATTRIBUTE = [
        'TLLINCOLN_HOTEL_ID'           => 0,
        'PLAN_ID'                      => 1,
        'ROOM_TYPE_CODE'               => 2,
        'SELL_DATE'                    => 3,
        'REMAINING_QUANTITY'           => 4,
        'SELL_STATUS'                  => 5,
        'PRICE_ONE_ADULT'              => 6,
        'PRICE_TWO_ADULTS'             => 7,
        'PRICE_THREE_ADULTS'           => 8,
        'PRICE_FOUR_ADULTS'            => 9,
        'PRICE_FIVE_ADULTS'            => 10,
        'PRICE_SIX_ADULTS'             => 11,
        'PRICE_SEVEN_ADULTS'           => 12,
        'PRICE_EIGHT_ADULTS'           => 13,
        'PRICE_NIGHT_ADULTS'           => 14,
        'PRICE_FOR_TEN_ADULTS_OR_MORE' => 15,
        'FLAG'                         => 16,
        'UPDATED_AT'                   => 17,
    ];

    const FLAG_NOT_DEL = 0;
}

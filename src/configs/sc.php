<?php

return [
    'tllincoln' => [
        'booking_handler' => \ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln\TlLincolnSoapService::class,
        'mapping_data_handler' => \ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln\TlLincolnMappingService::class,
    ],
    'tllincoln_api' => [
        'agt_id' => env('SC_TLLINCOLN_AGT_ID'),
        'agt_password' => env('SC_TLLINCOLN_AGT_PASSWORD'),
        'date_format' => 'Y-m-d',
        'time_format' => 'h:i:s',
        'get_empty_room_series_url' => env('SC_TLLINCOLN_URL_SOAP_API') . 'RoomAndPlanInquirySalesStsService',
        'get_empty_room_url' =>  env('SC_TLLINCOLN_URL_SOAP_API') . 'RoomAndPlanInquirySalesStsService',
        'get_plan_price_url' =>  env('SC_TLLINCOLN_URL_SOAP_API') . 'RoomAndPlanInquirySalesStsService',
        'get_plan_price_series_url' =>  env('SC_TLLINCOLN_URL_SOAP_API') . 'RoomAndPlanInquiryAnyUnitPriceSalesStsService',
        'check_pre_booking_url' =>  env('SC_TLLINCOLN_URL_SOAP_API') . 'ReservationControlService',
        'entry_booking_url' =>  env('SC_TLLINCOLN_URL_SOAP_API') . 'ReservationControlService',
        'cancel_booking_url' =>  env('SC_TLLINCOLN_URL_SOAP_API') . 'ReservationControlServiceWithCP',
        'command_cancel_booking' => env('SC_TLLINCOLN_URL_SOAP_API') . 'deleteBookingWithCP',
        'get_master_url' => env('SC_TLLINCOLN_MASTER_DOWNLOAD_URL'),
        'get_partial_url' => env('SC_TLLINCOLN_PARTIAL_DOWNLOAD_URL'),
        'api_file_type_const' => [
            'file_master_hotel' => 11,
            'file_master_room_type' => 12,
            'file_master_plan' => 13,
            'file_diff_master_room_type' => 22,
            'file_diff_master_plan' => 23,
            'file_diff_empty_room' => 24,
            'file_diff_price_plan' => 28,
        ],
        'api_search_type_const' => [
            'new' => 1,
            'by_date' => 2,
            'by_file_number' => 3
        ],
        'get_empty_room_max_day' => 30,
        'tllincoln_date_format_api' => 'Ymd',
        'system_format_time' => 'h:m:s',
        'empty_room_max_month' => 13,
        'naif_xml_version' => [
            'naif_3000' => 3000,
        ],
        'result_code_xml' => [
            'success' => 'True',
            'fail' => 'False',
        ],
        'mapping_plan_tllincoln' => 0,
        'not_mapping_plan_tllincoln' => 1,
        'sales_office_code' => 1001, //TODO change
        'sales_office_name' => 'Test', //TODO change
        'using_plan_tllincoln' => 0,
    ],
];

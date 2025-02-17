<?php

namespace ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln;

use ThachVd\LaravelSiteControllerApi\Models\ScTlLincolnSoapApiLog;
use ThachVd\LaravelSiteControllerApi\Services\Sc\Xml2Array\Xml2Array;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

/**
 *
 */
class TlLincolnSoapService
{
    /**
     * @var TlLincolnSoapClient
     */
    protected $tlLincolnSoapClient;
    /**
     * @var TlLincolnSoapBody
     */
    protected $tlLincolnSoapBody;

    /**
     * @param TlLincolnSoapClient $tlLincolnSoapClient
     * @param TlLincolnSoapBody $tlLincolnSoapBody
     */
    public function __construct(TlLincolnSoapClient $tlLincolnSoapClient, TlLincolnSoapBody $tlLincolnSoapBody)
    {
        $this->tlLincolnSoapClient = $tlLincolnSoapClient;
        $this->tlLincolnSoapBody   = $tlLincolnSoapBody;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEmptyRoom(Request $request)
    {
        $dateValidation = $this->validateAndParseDates($request);
        if (isset($dateValidation['success']) && !$dateValidation['success']) {
            return $dateValidation;
        }

        $command = 'roomAvailabilitySalesSts';
        // set header request
        $this->tlLincolnSoapClient->setHeaders();
        // set body request
        $this->setEmptyRoomSoapRequest($dateValidation, $request);

        try {
            $url        = config('sc.tllincoln_api.get_empty_room_url');
            $soapApiLog = [
                'data_id' => ScTlLincolnSoapApiLog::genDataId(),
                'url'     => $url,
                'command' => $command,
                "request" => $this->tlLincolnSoapClient->getBody(),
            ];
            $response   = $this->tlLincolnSoapClient->callSoapApi($url);

            $data    = [];
            $success = true;

            if ($response !== null) {
                $rooms = $this->tlLincolnSoapClient->convertResponeToArray($response);

                if (isset($rooms['ns2:roomAvailabilitySalesStsResponse']['roomAvailabilitySalesStsResult']['hotelInfos'])) {
                    $data = $rooms['ns2:roomAvailabilitySalesStsResponse']['roomAvailabilitySalesStsResult']['hotelInfos'];
                }
            } else {
                $success = false;
            }

            $soapApiLog['response']   = $response;
            $soapApiLog['is_success'] = $success;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => $success,
                'data'    => $data,
            ]);
        } catch (\Exception $e) {
            $soapApiLog['response']   = $e->getMessage();
            $soapApiLog['is_success'] = false;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBulkEmptyRoom(Request $request)
    {
        $command = 'roomAvailabilityAllSalesSts';
        // set header request
        $this->tlLincolnSoapClient->setHeaders();
        // set body request
        $this->setBulkEmptyRoomSoapRequest($request);
        try {
            $url        = config('sc.tllincoln_api.get_empty_room_series_url');
            $soapApiLog = [
                'data_id' => ScTlLincolnSoapApiLog::genDataId(),
                'url'     => $url,
                'command' => $command,
                "request" => $this->tlLincolnSoapClient->getBody(),
            ];

            $response = $this->tlLincolnSoapClient->callSoapApi($url);

            $data    = [];
            $success = true;

            if ($response !== null) {
                $arrRooms = $this->tlLincolnSoapClient->convertResponeToArray($response);

                if (isset($arrRooms['ns2:roomAvailabilityAllSalesStsResponse']['roomAvailabilityAllSalesStsResult']['hotelInfos'])) {
                    $data = $arrRooms['ns2:roomAvailabilityAllSalesStsResponse']['roomAvailabilityAllSalesStsResult']['hotelInfos'];
                }
            } else {
                $success = false;
            }

            $soapApiLog['response']   = $response;
            $soapApiLog['is_success'] = $success;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => $success,
                'data'    => $data,
                'date'    => now()->format(config('sc.tllincoln_api.date_format')),
            ]);
        } catch (\Exception $e) {
            $soapApiLog['response']   = $e->getMessage();
            $soapApiLog['is_success'] = false;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPricePlan(Request $request)
    {
        $dateValidation = $this->validateAndParseDates($request);
        if (isset($dateValidation['success']) && !$dateValidation['success']) {
            return $dateValidation;
        }

        $command = 'planPriceInfoAcquisition';
        // set header request
        $this->tlLincolnSoapClient->setHeaders();
        // set body request
        $this->setPricePlanSoapRequest($dateValidation, $request);

        try {
            $url        = config('sc.tllincoln_api.get_plan_price_url');
            $soapApiLog = [
                'data_id' => ScTlLincolnSoapApiLog::genDataId(),
                'url'     => $url,
                'command' => $command,
                "request" => $this->tlLincolnSoapClient->getBody(),
            ];
            $response   = $this->tlLincolnSoapClient->callSoapApi($url);
            $data       = [];
            $success    = true;

            if ($response !== null) {
                $arrPlans = $this->tlLincolnSoapClient->convertResponeToArray($response);
                if (isset($arrPlans['ns2:planPriceInfoAcquisitionResponse']['planPriceInfoResult']['hotelInfos'])) {
                    $data = $arrPlans['ns2:planPriceInfoAcquisitionResponse']['planPriceInfoResult']['hotelInfos'];
                }
            } else {
                $success = false;
            }

            $soapApiLog['response']   = $response;
            $soapApiLog['is_success'] = $success;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => $success,
                'data'    => $data,
            ]);
        } catch (\Exception $e) {
            $soapApiLog['response']   = $e->getMessage();
            $soapApiLog['is_success'] = false;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBulkPricePlan(Request $request)
    {
        $command = 'planPriceInfoAcquisitionAll';
        // set header request
        $this->tlLincolnSoapClient->setHeaders();
        // set body request
        $this->setBulkPricePlanSoapRequest($request);

        try {
            $url        = config('sc.tllincoln_api.get_plan_price_series_url');
            $soapApiLog = [
                'data_id' => ScTlLincolnSoapApiLog::genDataId(),
                'url'     => $url,
                'command' => $command,
                "request" => $this->tlLincolnSoapClient->getBody(),
            ];
            $response   = $this->tlLincolnSoapClient->callSoapApi($url);
            $data       = [];
            $success    = true;

            if ($response !== null) {
                $arrPrices = $this->tlLincolnSoapClient->convertResponeToArray($response);
                if (isset($arrPrices['ns2:planPriceInfoAcquisitionAllResponse']['planPriceInfoAllResult']['hotelInfos'])) {
                    $data = $arrPrices['ns2:planPriceInfoAcquisitionAllResponse']['planPriceInfoAllResult']['hotelInfos'];
                }
            } else {
                $success = false;
            }

            $soapApiLog['response']   = $response;
            $soapApiLog['is_success'] = $success;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => $success,
                'data'    => $data,
                'date' => now()->format(config('sc.tllincoln_api.date_format')),
            ]);
        } catch (\Exception $e) {
            $soapApiLog['response']   = $e->getMessage();
            $soapApiLog['is_success'] = false;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public function createBooking(Request $request)
    {
        // precheck create booking
        $preCheckBookingResponse = $this->preCheckCreateBooking($request);
        //TODO check preCheckBookingResponse success

        // entry booking
        $entryBookingResponse = $this->entryBooking($request);
        // TODO check entryBookingResponse success
        // TODO return response to client
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function preCheckCreateBooking(Request $request)
    {
        $url     = config('sc.tllincoln_api.check_pre_booking_url');
        $command = 'preBooking';

        $response = $this->processBooking($url, $command, $request);

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function entryBooking(Request $request)
    {
        $url     = config('sc.tllincoln_api.entry_booking_url');
        $command = 'entryBooking';

        $response = $this->processBooking($url, $command, $request);

        return response()->json($response);
    }

    /**
     * @param $url
     * @param $command
     * @param Request $request
     * @return mixed
     */
    public function processBooking($url, $command, Request $request)
    {
        $dataRequest = $this->setCreateBookingSoapRequest($request);
        try {
            $soapApiLog = [
                'data_id' => ScTlLincolnSoapApiLog::genDataId(),
                'url'     => $url,
                'command' => $command,
                "request" => $this->tlLincolnSoapClient->getBody(),
            ];
            $response   = $this->tlLincolnSoapClient->callSoapApi($url);
            $data       = [];
            $success    = true;
            $message    = ["TL エラー:"];

            if ($response !== null) {
                $data           = Xml2Array::toArray($response);
                $commonResponse = $data['S:Body']['ns2:' . $command . 'Response'][$command . 'Result']['commonResponse'];
                $success        = $commonResponse['resultCode'] === "True";

                if (!$success) {
                    if (isset($commonResponse['errorInfos']['errorMsg'])) {
                        $message[] = $commonResponse['errorInfos']['errorMsg'];
                        \Log::info("Meet TLL Error Code {$commonResponse['errorInfos']['errorCode']}");
                        $data["errorCode"] = $commonResponse['errorInfos']['errorCode'];
                    } else {
                        foreach ($commonResponse['errorInfos'] as $error) {
                            $message[] = $error['errorMsg'];
                        }
                    }
                } else {
                    // handle response data
                    if (isset($data['S:Body']['ns2:' . $command . 'Response'][$command . 'Result']['extendLincoln'])) {
                        $data = $data['S:Body']['ns2:' . $command . 'Response'][$command . 'Result']['extendLincoln'];
                    }
                }
            } else {
                $success = false;
            }

            $soapApiLog['response']   = $response;
            $soapApiLog['is_success'] = $success;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => $success,
                'message' => $success ? [] : $message,
                'data'    => $data,
            ]);
        } catch (\Exception $e) {
            $soapApiLog['response']   = $e->getMessage();
            $soapApiLog['is_success'] = false;
            ScTlLincolnSoapApiLog::createLog($soapApiLog);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function setCreateBookingSoapRequest(Request $request)
    {
        $tllHotelId                       = $request->get('tll_hotel_id');       // TODO pass tl lincoln hotel id
        $tllBookingNumber                 = $request->get('tll_booking_number'); // TODO pass tl lincoln booking number
        $dataClassification               = empty($tllBookingNumber) ? 'NewBookReport' : 'ModificationReport';
        $bookingId                        = $request->get('booking_id');   // TODO pass booking id of system
        $requestorId                      = $request->get('requestor_id'); // TODO apply for OTA
        $useTllPlan                       = $request->get('use_tll_plan'); // TODO pass tl lincoln plan id
        $totalAccommodationCharge         = 0;
        $totalAccommodationConsumptionTax = 0;
        $tlLincolnPlan                    = collect();
        $bookingSystem                    = collect();
        $tlLincolnMealBreakfast           = $tlLincolnPlan->tllincoln_plan_course_meal_breakfast; // TODO pass tl lincoln plan breakfast
        $tlLincolnMealDinner              = $tlLincolnPlan->tllincoln_plan_course_meal_dinner;    // TODO pass tl lincoln plan dinner
        $tlLincolnMealLunch               = $tlLincolnPlan->tllincoln_plan_course_meal_lunch;     // TODO pass tl lincoln plan lunch

        switch (true) {
            case ($tlLincolnMealBreakfast && $tlLincolnMealDinner && $tlLincolnMealLunch):
                $tlLincolnMeals         = "Other";
                $tlLincolnSpecificMeals = "IncludingBreakfastAndLunchAndDinner";
                break;
            case ($tlLincolnMealBreakfast && $tlLincolnMealDinner):
                $tlLincolnMeals         = "1night2meals";
                $tlLincolnSpecificMeals = "IncludingBreakfastAndDinner";
                break;
            case ($tlLincolnMealBreakfast && $tlLincolnMealLunch):
                $tlLincolnMeals         = "1night2meals";
                $tlLincolnSpecificMeals = "IncludingBreakfastAndLunch";
                break;
            case ($tlLincolnMealLunch && $tlLincolnMealDinner):
                $tlLincolnMeals         = "1night2meals";
                $tlLincolnSpecificMeals = "IncludingLunchAndDinner";
                break;
            case $tlLincolnMealLunch:
                $tlLincolnMeals         = "Other";
                $tlLincolnSpecificMeals = "IncludingLunch";
                break;
            case $tlLincolnMealDinner:
                $tlLincolnMeals         = "Other";
                $tlLincolnSpecificMeals = "IncludingDinner";
                break;
            case $tlLincolnMealBreakfast:
                $tlLincolnMeals         = "1nightBreakfast";
                $tlLincolnSpecificMeals = "IncludingBreakfast";
                break;
            default:
                $tlLincolnMeals         = "WithoutMeal";
                $tlLincolnSpecificMeals = "";
        }

        $accommodationName = ''; // TODO pass facility name of booking
        $accommodationCode = ''; // TODO pass facility id of booking
        $salesOfficeName   = ''; // TODO pass sales office name of booking
        $salesOfficeCode   = ''; // TODO pass sales office code of booking
        $bookingDate       = Carbon::parse($bookingSystem->created_at);
        $checkInDate       = Carbon::parse($bookingSystem->checkin_date);
        $checkOutDate      = Carbon::parse($bookingSystem->checkout_date);
        $rooms             = json_decode($request->get('rooms'), true);
        $checkInRooms      = collect($rooms[$checkInDate->format(config('sc.tllincoln_api.date_format'))]);
        $people            = json_decode($request->get('people'), true);
        // total child count or not count
        $grandTotalPaxCount            = (int)$people['adult_qty']
            + (int)$people['child_primary_school_qty']
            + (int)$people['child_meal_and_mattress_qty']
            + (int)$people['child_mattress_qty']
            + (int)$people['child_meal_qty']
            + (int)$people['child_not_meal_and_not_mattress_qty']
            + (int)$people['no_count_child_primary_school_qty']
            + (int)$people['no_count_child_meal_and_mattress_qty']
            + (int)$people['no_count_child_mattress_qty']
            + (int)$people['no_count_child_meal_qty']
            + (int)$people['no_count_child_not_meal_and_not_mattress_qty'];
        $roomQuatity                   = $bookingSystem->room_quantity;
        $childCount                    = (int)$people['child_primary_school_qty'] > 0 ? (int)$people['child_primary_school_qty'] : (int)$people['no_count_child_primary_school_qty'];
        $childMealAndMattressCount     = (int)$people['child_meal_and_mattress_qty'] > 0 ? (int)$people['child_meal_and_mattress_qty'] : (int)$people['no_count_child_meal_and_mattress_qty'];
        $childMattressCount            = (int)$people['child_mattress_qty'] > 0 ? (int)$people['child_mattress_qty'] : (int)$people['no_count_child_mattress_qty'];
        $childMealCount                = (int)$people['child_meal_qty'] > 0 ? (int)$people['child_meal_qty'] : (int)$people['no_count_child_meal_qty'];
        $childNoMealAndNoMattressCount = (int)$people['child_not_meal_and_not_mattress_qty'] > 0 ? (int)$people['child_not_meal_and_not_mattress_qty'] : (int)$people['no_count_child_not_meal_and_not_mattress_qty'];
        $plan                          = $bookingSystem->plan;

        // TODO add model Plan
        //$meals = [
        //    Plan::COURSE_MEAL['TWO_MEALS'] => "1night2meals",
        //    Plan::COURSE_MEAL['BREAKFAST_ONLY'] => "1nightBreakfast",
        //    Plan::COURSE_MEAL['DINNER_ONLY'] => "Other",
        //    Plan::COURSE_MEAL['NO_MEALS'] => "WithoutMeal",
        //];
        //$specificMeals = [
        //    Plan::COURSE_MEAL['TWO_MEALS'] => "IncludingBreakfastAndDinner",
        //    Plan::COURSE_MEAL['BREAKFAST_ONLY'] => "IncludingBreakfast",
        //    Plan::COURSE_MEAL['DINNER_ONLY'] => "IncludingDinner",
        //    Plan::COURSE_MEAL['NO_MEALS'] => "",
        //];
        //$otherService = [
        //    CRSPlan::COURSE_MEAL['TWO_MEALS'] => "朝昼食付",
        //    CRSPlan::COURSE_MEAL['BREAKFAST_ONLY'] => "",
        //    CRSPlan::COURSE_MEAL['DINNER_ONLY'] => "",
        //    CRSPlan::COURSE_MEAL['NO_MEALS'] => "",
        //];

        $options                        = json_decode($request->get('options'), true);
        $reservations                   = json_decode($request->get('reservations'), true);
        $slot                           = json_decode($request->get('slot'), true);
        $totalAccommodationHotSpringTax = 0;
        $period                         = CarbonPeriod::create($checkInDate, $checkOutDate);
        foreach ($period as $stayDate) {
            $stayDateStr = $stayDate->format(config('sc.tllincoln_api.date_format'));

            // set options
            if (isset($options[$stayDateStr])) {
                foreach ($options[$stayDateStr] as $option) {
                    $totalAccommodationCharge         += $option['amount'] ?? 0; // TODO change for charge
                    $totalAccommodationConsumptionTax += $option['amount'] ?? 0; // TODO change for consumption tax
                    $totalAccommodationHotSpringTax   += 0;                      // TODO change for onsen

                    $itemOption = [
                        "OptionDate"  => $stayDateStr,
                        "OptionCode"  => '', // TODO change
                        "Name"        => '', // TODO change option name
                        "NameRequest" => '',
                        "OptionCount" => $option['quantity'],   // TODO change option quantity
                        "OptionRate"  => $option['unit_price'], // TODO change option unit price
                    ];

                    if (!isset($strOption["OptionList"])) {
                        $strOption["OptionList"] = [$itemOption];
                    } else {
                        $strOption["OptionList"][] = $itemOption;
                    }
                }
            }
        }

        $totalAccommodationDiscountPoints = 0;
        $dataId                           = ScTlLincolnSoapApiLog::genDataId();
        $taxLocal                         = "";
        $amountClaimed                    = 0;
        $pointsDiscountList               = 0;
        $memberName                       = "";
        $memberKanjiName                  = "";
        $memberDateOfBirth                = "";
        $memberGenderDiv                  = "";
        $memberPhoneNumber                = "";
        $memberEmail                      = "";
        $memberPostalCode                 = "";
        $memberAddress                    = "";
        $strSlot                          = [];
        $dataRequest                      = [
            "extendLincoln"          => [
                "tllHotelCode"     => $tllHotelId,
                "useTllPlan"       => $useTllPlan,
                "tllBookingNumber" => $tllBookingNumber,
                "tllCharge"        => ""
            ],
            "SendInformation"        => [
                "assignDiv" => 1,
                "genderDiv" => 0,
            ],
            "AllotmentBookingReport" => [
                "TransactionType"          => [
                    "DataFrom"           => "FromTravelAgency",
                    "DataClassification" => $dataClassification,
                    "DataID"             => $dataId
                ],
                "AccommodationInformation" => [
                    "AccommodationArea" => "",
                    "AccommodationName" => mb_substr($accommodationName, 0, 15, 'UTF-8'),
                    "AccommodationCode" => $accommodationCode,
                    "ChainName"         => "",
                ],
                "SalesOfficeInformation"   => [
                    "SalesOfficeCompanyName"    => "Staynavi",
                    "SalesOfficeName"           => $salesOfficeName,
                    "SalesOfficeCode"           => $salesOfficeCode,
                    "SalesOfficePersonInCharge" => "",
                    "SalesOfficeEmail"          => "",
                    "SalesOfficePhoneNumber"    => "",
                    "SalesOfficeFaxNumber"      => ""
                ],
                "BasicInformation"         => [
                    "TravelAgencyBookingNumber"  => $bookingSystem->booking_code,
                    "TravelAgencyBookingDate"    => $bookingDate->format(config('sc.tllincoln_api.date_format')),
                    "TravelAgencyBookingTime"    => $bookingDate->format(config('sc.tllincoln_api.time_format')),
                    "GuestOrGroupMiddleName"     => "",
                    "GuestOrGroupNameSingleByte" => "", // TODO change
                    "GuestOrGroupKanjiName"      => "", // TODO change
                    "GuestOrGroupContactDiv"     => "",
                    "GuestOrGroupCellularNumber" => "",
                    "GuestOrGroupOfficeNumber"   => "",
                    "GuestOrGroupPhoneNumber"    => "", // TODO change
                    "GuestOrGroupEmail"          => "", // TODO change
                    "GuestOrGroupPostalCode"     => "", // TODO change
                    "GuestOrGroupAddress"        => "", // TODO change
                    "GroupNameWelcomeBoard"      => "",
                    "GuestGenderDiv"             => "", // TODO change
                    "GuestGeneration"            => "",
                    "GuestAge"                   => "",
                    "CheckInDate"                => $checkInDate->format(config('sc.tllincoln_api.date_format')),
                    "CheckInTime"                => "", // TODO change
                    "CheckOutDate"               => $checkOutDate->format(config('sc.tllincoln_api.date_format')),
                    "CheckOutTime"               => "", // TODO change
                    "Nights"                     => $bookingSystem->stay_night_number,
                    "Transportaion"              => "",
                    "TotalRoomCount"             => $roomQuatity,
                    "GrandTotalPaxCount"         => $grandTotalPaxCount * $roomQuatity,
                    "TotalPaxMaleCount"          => (int)($people['adult_qty'] * $roomQuatity),
                    "TotalPaxFemaleCount"        => 0,
                    "TotalChildA70Count"         => $childCount > 0 ? $childCount : "",
                    "TotalChildA70Count2"        => "",
                    "TotalChildB50Count"         => $childMealAndMattressCount > 0 ? $childMealAndMattressCount : "",
                    "TotalChildB50Count2"        => $childMealCount > 0 ? $childMealCount : "",
                    "TotalChildC30Count"         => $childMattressCount > 0 ? $childMattressCount : "",
                    "TotalChildDNoneCount"       => $childNoMealAndNoMattressCount > 0 ? $childNoMealAndNoMattressCount : "",
                    "TypeOfGroupDoubleByte"      => "", // TODO change
                    "PackageType"                => "",
                    "PackagePlanName"            => $plan->name,
                    "PackagePlanCode"            => $plan->tllincoln_plan_code,
                    "PackagePlanContent"         => $plan->description,
                    "MealCondition"              => $tlLincolnMeals,
                    "SpecificMealCondition"      => $tlLincolnSpecificMeals,
                    "ModificationPoint"          => "",
                    "SpecialServiceRequest"      => $bookingSystem->note ?? "",
                    "OtherServiceInformation"    => $taxLocal ?? "",
                    "SalesOfficeComment"         => "",
                    "QuestionAndAnswerList"      => [
                        "FromHotelQuestion" => mb_substr($plan->question_to_customer, 0, 100, 'UTF-8') ?? "",
                        "ToHotelAnswer"     => $booking->answer ?? "",
                    ]
                ],
                "BasicRateInformation"     => [
                    "RoomRateOrPersonalRate"                              => "PersonalRate", // TODO change
                    "TaxServiceFee"                                       => "IncludingServiceAndTax",
                    "Payment"                                             => "",
                    "SettlementDiv"                                       => "", // TODO change
                    "TotalAccommodationCharge"                            => $totalAccommodationCharge,
                    "TotalAccommodationConsumptionTax"                    => $totalAccommodationConsumptionTax,
                    "TotalAccommodationHotSpringTax"                      => $totalAccommodationHotSpringTax,
                    "TotalAccomodationServiceCharge"                      => 0,
                    "TotalAccommodationDiscountPoints"                    => $totalAccommodationDiscountPoints,
                    "TotalAccommodationConsumptionTaxAfterDiscountPoints" => "",
                    "AmountClaimed"                                       => $amountClaimed,
                    "PointsDiscountList"                                  => $pointsDiscountList,
                    "DepositList"                                         => [
                        "DepositAmount" => "", //TODO: check deposit

                    ],
                    "CurrencyCode"                                        => "JPY",
                ],
                "MemberInformation"        => [
                    "MemberName"                  => $memberName,
                    "MemberKanjiName"             => $memberKanjiName,
                    "MemberMiddleName"            => "",
                    "MemberDateOfBirth"           => $memberDateOfBirth,
                    "MemberEmergencyNumber"       => "",
                    "MemberOccupation"            => "",
                    "MemberOrganization"          => "",
                    "MemberOrganizationKana"      => "",
                    "MemberOrganizationCode"      => "",
                    "MemberPosition"              => "",
                    "MemberOfficePostalCode"      => "",
                    "MemberOfficeAddress"         => "",
                    "MemberOfficeTelephoneNumber" => "",
                    "MemberOfficeFaxNumber"       => "",
                    "MemberGenderDiv"             => $memberGenderDiv ?? "",
                    "MemberClass"                 => "",
                    "CurrentPoints"               => "",
                    "MailDemandDiv"               => "",
                    "PamphletDemandDiv"           => "",
                    "MemberID"                    => "",
                    "MemberPhoneNumber"           => $memberPhoneNumber ?? "",
                    "MemberEmail"                 => $memberEmail ?? "",
                    "MemberPostalCode"            => $memberPostalCode ?? "",
                    "MemberAddress"               => $memberAddress ?? "",
                ],
                "OptionInformation"        => $strOption,
                "RoomInformationList"      => [
                    "RoomAndGuestList" => $strSlot
                ]
            ]
        ];

        return $dataRequest;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    private function validateAndParseDates(Request $request)
    {
        $dateFormat = config('sc.tllincoln_api.tllincoln_date_format_api');
        $dateFrom   = $request->input('date_from');
        $dateTo     = $request->input('date_to');
        try {
            $startDay  = $dateFrom ? Carbon::parse($dateFrom)->format($dateFormat) : Carbon::now()->format($dateFormat);
            $endDay    = $dateTo ? Carbon::parse($dateTo)->format($dateFormat) : Carbon::parse($startDay)->addDay(
                config('sc.tllincoln_api.get_empty_room_max_day')
            )->format($dateFormat);
            $endDayMax = Carbon::parse($startDay)->addDays(30)->format($dateFormat);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'date input is not valid!'
            ]);
        }

        $validator = \Validator::make($request->all(), [
            'date_from' => ['nullable', 'date', 'date_format:' . $dateFormat],
            'date_to'   => [
                'nullable',
                'date',
                'date_format:' . $dateFormat,
                'after_or_equal:date_from',
                'before_or_equal:' . $endDayMax
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        return compact('startDay', 'endDay');
    }

    /**
     * @param array $dateValidation
     * @param Request $request
     * @return void
     */
    public function setEmptyRoomSoapRequest(array $dateValidation, Request $request): void
    {
        $startDay       = $dateValidation['startDay'];
        $endDay         = $dateValidation['endDay'];
        $perRmPaxCount  = $request->input('person_number');
        $tllHotelCode   = $request->input('tllHotelCode');
        $tllRmTypeCode  = $request->input('tllRmTypeCode');
        $tllRmTypeInfos = [];

        if (!is_array($tllRmTypeCode)) {
            $tllRmTypeInfos['tllRmTypeCode'] = $tllRmTypeCode;
        } else {
            foreach ($tllRmTypeCode as $item) {
                $tllRmTypeInfos[] = ['tllRmTypeCode' => $item];
            }
        }

        $dataRequest = [
            'extractionRequest' => [
                'startDay'      => $startDay,
                'endDay'        => $endDay,
                'perRmPaxCount' => $perRmPaxCount,
            ],
            'hotelInfos'        => [
                'tllHotelCode'   => $tllHotelCode,
                'tllRmTypeInfos' => $tllRmTypeInfos
            ]
        ];

        $this->tlLincolnSoapBody->setMainBodyWrapSection('roomAvailabilitySalesStsRequest');
        $userInfo = [
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password')
        ];

        $body = $this->tlLincolnSoapBody->generateBody('roomAvailabilitySalesSts', $dataRequest, null, $userInfo);
        $this->tlLincolnSoapClient->setBody($body);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setBulkEmptyRoomSoapRequest(Request $request): void
    {
        $tllHotelCode   = $request->input('tllHotelCode');
        $tllRmTypeCode  = $request->input('tllRmTypeCode');
        $tllRmTypeInfos = [];

        if (!is_array($tllRmTypeCode)) {
            $tllRmTypeInfos['tllRmTypeCode'] = $tllRmTypeCode;
        } else {
            foreach ($tllRmTypeCode as $item) {
                $tllRmTypeInfos[] = ['tllRmTypeCode' => $item];
            }
        }

        $dataRequest = [
            'hotelInfos' => [
                'tllHotelCode'   => $tllHotelCode,
                'tllRmTypeInfos' => $tllRmTypeInfos
            ]
        ];

        $this->tlLincolnSoapBody->setMainBodyWrapSection('roomAvailabilityAllSalesStsRequest');
        $userInfo = [
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password')
        ];

        $body = $this->tlLincolnSoapBody->generateBody('roomAvailabilityAllSalesSts', $dataRequest, null, $userInfo);
        $this->tlLincolnSoapClient->setBody($body);
    }

    /**
     * @param array $dateValidation
     * @param Request $request
     * @return void
     */
    public function setPricePlanSoapRequest(array $dateValidation, Request $request): void
    {
        $startDay      = $dateValidation['startDay'];
        $endDay        = $dateValidation['endDay'];
        $minPrice      = $request->input('min_price');
        $maxPrice      = $request->input('max_price');
        $perPaxCount   = $request->input('person_number');
        $tllHotelCode  = $request->input('tllHotelCode');
        $tllRmTypeCode = $request->input('tllRmTypeCode');
        $tllPlanCode   = $request->input('tllPlanCode');
        $tllPlanInfos  = [];
        if (!is_array($tllPlanCode)) {
            $tllPlanInfos['tllPlanCode'] = $tllPlanCode;
        } else {
            foreach ($tllPlanCode as $item) {
                $tllPlanInfos[] = ['tllPlanCode' => $item];
            }
        }
        if (!is_array($tllRmTypeCode)) {
            $tllPlanInfos['tllRmTypeCode'] = $tllRmTypeCode;
        } else {
            foreach ($tllRmTypeCode as $item) {
                $tllPlanInfos[] = ['tllRmTypeCode' => $item];
            }
        }

        $dataRequest = [
            'extractionRequest' => [
                'startDay'    => $startDay,
                'endDay'      => $endDay,
                'minPrice'    => $minPrice,
                'maxPrice'    => $maxPrice,
                'perPaxCount' => $perPaxCount
            ],
            'hotelInfos'        => [
                'tllHotelCode' => $tllHotelCode,
                'tllPlanInfos' => $tllPlanInfos
            ]
        ];


        $this->tlLincolnSoapBody->setMainBodyWrapSection('planPriceInfoAcquisitionRequest');
        $userInfo = [
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password')
        ];
        $body     = $this->tlLincolnSoapBody->generateBody('planPriceInfoAcquisition', $dataRequest, null, $userInfo);
        $this->tlLincolnSoapClient->setBody($body);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setBulkPricePlanSoapRequest(Request $request): void
    {
        $tllHotelCode  = $request->input('tllHotelCode');
        $tllRmTypeCode = $request->input('tllRmTypeCode');
        $tllPlanCode   = $request->input('tllPlanCode');
        $dateNow       = Carbon::now();

        $tllRmTypeInfos = [];
        if (!is_array($tllRmTypeCode)) {
            $tllRmTypeInfos['tllRmTypeCode'] = $tllRmTypeCode;
            $tllRmTypeInfos['tllPlanCode']   = $tllPlanCode;
        } else {
            foreach ($tllRmTypeCode as $item) {
                $tllRmTypeInfos[] = ['tllRmTypeCode' => $item, 'tllPlanCode' => $tllPlanCode];
            }
        }

        $dataRequest = [
            'hotelInfos' => [
                'tllHotelCode' => $tllHotelCode,
                'tllPlanInfos' => $tllRmTypeInfos
            ]
        ];


        $this->tlLincolnSoapBody->setMainBodyWrapSection('planPriceInfoAcquisitionAllRequest');
        $userInfo = [
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password')
        ];
        $body     = $this->tlLincolnSoapBody->generateBody(
            'planPriceInfoAcquisitionAll',
            $dataRequest,
            null,
            $userInfo
        );
        $this->tlLincolnSoapClient->setBody($body);
    }
}

<?php

namespace ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use ThachVd\LaravelSiteControllerApi\Models\ScApiLog;
use ThachVd\LaravelSiteControllerApi\Models\TlLincolnEmptyRoom;
use ThachVd\LaravelSiteControllerApi\Models\TlLincolnHotel;
use ThachVd\LaravelSiteControllerApi\Models\TlLincolnPlan;
use ThachVd\LaravelSiteControllerApi\Models\TlLincolnPlanPrice;
use ThachVd\LaravelSiteControllerApi\Models\TlLincolnRoomType;

/**
 *
 */
class TlLincolnService
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var array
     */
    protected $query_params = [];
    /**
     * @var array
     */
    protected $body = [];

    /**
     * @var
     */
    protected $mappingHandler;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers = [])
    {
        $commonHeaders         = [
            'Accept-Encoding' => 'gzip',
            'Content-type'    => 'application/download',
        ];
        $this->client->headers = array_merge($commonHeaders, $headers);
    }

    /**
     * @param array $query_params
     * @return void
     */
    protected function setQueryParams(array $query_params = [])
    {
        $this->client->query_params = $query_params;
    }

    /**
     * @param array $item
     * @return array
     */
    public function extractedRoomType(array $item): array
    {
        $tlLincolnHotelId = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']] : null;
        $status           = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['STATUS']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['STATUS']] : null;
        $code             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['CODE']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['CODE']] : null;
        $name             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['NAME']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['NAME']] : null;
        $description      = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['DESCRIPTION']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['DESCRIPTION']] : null;
        $minPerson        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['MIN_PERSON']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['MIN_PERSON']] : null;
        $maxPerson        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['MAX_PERSON']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['MAX_PERSON']] : null;
        $type             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['TYPE']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['TYPE']] : null;
        $smoking          = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['SMOKING']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['SMOKING']] : null;
        $noSmoking        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['NO_SMOKING']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['NO_SMOKING']] : null;
        $bus              = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['BUS']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['BUS']] : null;
        $toilet           = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['TOILET']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['TOILET']] : null;
        $internet         = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['INTERNET']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['INTERNET']] : null;
        $imageUrl         = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_URL']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_URL']] : null;
        $imageCaption     = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_CAPTION']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_CAPTION']] : null;
        $imageUpdatedAt   = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_UPDATED_AT']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_UPDATED_AT']] : null;
        $flag             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['FLAG']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['FLAG']] : null;
        $codeOthers       = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['CODE_OTHERS']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['CODE_OTHERS']] : null;
        $updatedAt        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE['UPDATED_AT']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE['UPDATED_AT']] : null;
        return array(
            $tlLincolnHotelId,
            $status,
            $code,
            $name,
            $description,
            $minPerson,
            $maxPerson,
            $type,
            $smoking,
            $noSmoking,
            $bus,
            $toilet,
            $internet,
            $imageUrl,
            $imageCaption,
            $imageUpdatedAt,
            $flag,
            $codeOthers,
            $updatedAt
        );
    }

    /**
     * @param array $item
     * @return array
     */
    public function extractedRoomTypeDiff(array $item): array
    {
        $tlLincolnHotelId = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['TLLINCOLN_HOTEL_ID']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['TLLINCOLN_HOTEL_ID']] : null;
        $status           = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['STATUS']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['STATUS']] : null;
        $code             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['CODE']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['CODE']] : null;
        $name             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['NAME']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['NAME']] : null;
        $description      = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['DESCRIPTION']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['DESCRIPTION']] : null;
        $minPerson        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['MIN_PERSON']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['MIN_PERSON']] : null;
        $maxPerson        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['MAX_PERSON']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['MAX_PERSON']] : null;
        $type             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['TYPE']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['TYPE']] : null;
        $smoking          = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['SMOKING']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['SMOKING']] : null;
        $noSmoking        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['NO_SMOKING']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['NO_SMOKING']] : null;
        $bus              = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['BUS']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['BUS']] : null;
        $toilet           = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['TOILET']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['TOILET']] : null;
        $internet         = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['INTERNET']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['INTERNET']] : null;
        $imageUrl         = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['IMAGE_URL']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['IMAGE_URL']] : null;
        $imageCaption     = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['IMAGE_CAPTION']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['IMAGE_CAPTION']] : null;
        $imageUpdatedAt   = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['IMAGE_UPDATED_AT']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['IMAGE_UPDATED_AT']] : null;
        $flag             = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['FLAG']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['FLAG']] : null;
        $updateType       = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['UPDATE_TYPE']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['UPDATE_TYPE']] : null;
        $codeOthers       = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['CODE_OTHERS']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['CODE_OTHERS']] : null;
        $updatedAt        = filled($item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['UPDATED_AT']]) ? $item[TlLincolnRoomType::CSV_ATTRIBUTE_DIFF['UPDATED_AT']] : null;
        return array(
            $tlLincolnHotelId,
            $status,
            $code,
            $name,
            $description,
            $minPerson,
            $maxPerson,
            $type,
            $smoking,
            $noSmoking,
            $bus,
            $toilet,
            $internet,
            $imageUrl,
            $imageCaption,
            $imageUpdatedAt,
            $flag,
            $updateType,
            $codeOthers,
            $updatedAt
        );
    }

    /**
     * @param array $item
     * @return array
     */
    public function extractedPlan(array $item): array
    {
        $roomStatus                  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['ROOM_STATUS']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['ROOM_STATUS']] : null;
        $planName                    = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NAME']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NAME']] : null;
        $planDescription             = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_DESCRIPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_DESCRIPTION']] : null;
        $planSellTimeFrom            = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_SELL_TIME_FROM']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_SELL_TIME_FROM']] : null;
        $planSellTimeTo              = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_SELL_TIME_TO']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_SELL_TIME_TO']] : null;
        $planStartUpload             = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_START_UPLOAD']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_START_UPLOAD']] : null;
        $planEndUpload               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_END_UPLOAD']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_END_UPLOAD']] : null;
        $planCourseMealBreakfast     = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_BREAKFAST']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_BREAKFAST']] : null;
        $planCourseMealDinner        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_DINNER']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_DINNER']] : null;
        $planCourseMealLunch         = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_LUNCH']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_LUNCH']] : null;
        $planAcceptBeforeDays        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ACCEPT_BEFORE_DAYS']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ACCEPT_BEFORE_DAYS']] : null;
        $planAcceptBeforeTime        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ACCEPT_BEFORE_TIME']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ACCEPT_BEFORE_TIME']] : null;
        $planCheckinTimeFrom         = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKIN_TIME_FROM']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKIN_TIME_FROM']] : null;
        $planCheckinTimeTo           = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKIN_TIME_TO']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKIN_TIME_TO']] : null;
        $planCheckoutTime            = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKOUT_TIME']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKOUT_TIME']] : null;
        $planTaxType                 = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_TAX_TYPE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_TAX_TYPE']] : null;
        $planLimitedQuantity         = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_LIMITED_QUANTITY']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_LIMITED_QUANTITY']] : null;
        $planCancellationPolicy      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CANCELLATION_POLICY']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CANCELLATION_POLICY']] : null;
        $planMinPerson               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_MIN_PERSON']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_MIN_PERSON']] : null;
        $planMaxPerson               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_MAX_PERSON']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_MAX_PERSON']] : null;
        $planFeeChildHighAccept      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_ACCEPT']] : null;
        $planFeeChildHighCount       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_COUNT']] : null;
        $planFeeChildHighValue       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_VALUE']] : null;
        $planFeeChildHighUnitOption  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_UNIT_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_UNIT_OPTION']] : null;
        $planFeeChildLowAccept       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_ACCEPT']] : null;
        $planFeeChildLowCount        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_COUNT']] : null;
        $planFeeChildLowValue        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_VALUE']] : null;
        $planFeeChildLowUnitOption   = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_UNIT_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_UNIT_OPTION']] : null;
        $planFeeChildMealSleepAccept = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_ACCEPT']] : null;
        $planFeeChildMealSleepCount  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_COUNT']] : null;
        $planFeeChildMealSleepValue  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_VALUE']] : null;
        $planFeeChildMealSleepOption = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_OPTION']] : null;
        $planFeeChildMealAccept      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_ACCEPT']] : null;
        $planFeeChildMealCount       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_COUNT']] : null;
        $planFeeChildMealValue       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_VALUE']] : null;
        $planFeeChildMealOption      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_OPTION']] : null;
        $planFeeChildSleepAccept     = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_ACCEPT']] : null;
        $planFeeChildSleepCount      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_COUNT']] : null;
        $planFeeChildSleepValue      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_VALUE']] : null;
        $planFeeChildSleepOption     = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_OPTION']] : null;
        $planFeeChildNoneAccept      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_ACCEPT']] : null;
        $planFeeChildNoneCount       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_COUNT']] : null;
        $planFeeChildNoneValue       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_VALUE']] : null;
        $planFeeChildNoneOption      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_OPTION']] : null;
        $planNightStayFrom           = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NIGHT_STAY_FROM']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NIGHT_STAY_FROM']] : null;
        $planNightStayTo             = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NIGHT_STAY_TO']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NIGHT_STAY_TO']] : null;
        $planUpdatedAt               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_UPDATED_AT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_UPDATED_AT']] : null;
        $planUseType                 = filled($item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_USE_TYPE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_USE_TYPE']] : null;
        return array(
            $roomStatus,
            $planName,
            $planDescription,
            $planSellTimeFrom,
            $planSellTimeTo,
            $planStartUpload,
            $planEndUpload,
            $planCourseMealBreakfast,
            $planCourseMealDinner,
            $planCourseMealLunch,
            $planAcceptBeforeDays,
            $planAcceptBeforeTime,
            $planCheckinTimeFrom,
            $planCheckinTimeTo,
            $planCheckoutTime,
            $planTaxType,
            $planLimitedQuantity,
            $planCancellationPolicy,
            $planMinPerson,
            $planMaxPerson,
            $planFeeChildHighAccept,
            $planFeeChildHighCount,
            $planFeeChildHighValue,
            $planFeeChildHighUnitOption,
            $planFeeChildLowAccept,
            $planFeeChildLowCount,
            $planFeeChildLowValue,
            $planFeeChildLowUnitOption,
            $planFeeChildMealSleepAccept,
            $planFeeChildMealSleepCount,
            $planFeeChildMealSleepValue,
            $planFeeChildMealSleepOption,
            $planFeeChildMealAccept,
            $planFeeChildMealCount,
            $planFeeChildMealValue,
            $planFeeChildMealOption,
            $planFeeChildSleepAccept,
            $planFeeChildSleepCount,
            $planFeeChildSleepValue,
            $planFeeChildSleepOption,
            $planFeeChildNoneAccept,
            $planFeeChildNoneCount,
            $planFeeChildNoneValue,
            $planFeeChildNoneOption,
            $planNightStayFrom,
            $planNightStayTo,
            $planUpdatedAt,
            $planUseType
        );
    }

    /**
     * @param array $item
     * @return array
     */
    public function extractedPlanDiff(array $item): array
    {
        $roomStatus                  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['ROOM_STATUS']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['ROOM_STATUS']] : null;
        $planName                    = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_NAME']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_NAME']] : null;
        $planDescription             = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_DESCRIPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_DESCRIPTION']] : null;
        $planSellTimeFrom            = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_SELL_TIME_FROM']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_SELL_TIME_FROM']] : null;
        $planSellTimeTo              = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_SELL_TIME_TO']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_SELL_TIME_TO']] : null;
        $planStartUpload             = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_START_UPLOAD']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_START_UPLOAD']] : null;
        $planEndUpload               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_END_UPLOAD']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_END_UPLOAD']] : null;
        $planCourseMealBreakfast     = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_COURSE_MEAL_BREAKFAST']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_COURSE_MEAL_BREAKFAST']] : null;
        $planCourseMealDinner        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_COURSE_MEAL_DINNER']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_COURSE_MEAL_DINNER']] : null;
        $planCourseMealLunch         = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_COURSE_MEAL_LUNCH']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_COURSE_MEAL_LUNCH']] : null;
        $planAcceptBeforeDays        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_ACCEPT_BEFORE_DAYS']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_ACCEPT_BEFORE_DAYS']] : null;
        $planAcceptBeforeTime        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_ACCEPT_BEFORE_TIME']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_ACCEPT_BEFORE_TIME']] : null;
        $planCheckinTimeFrom         = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CHECKIN_TIME_FROM']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CHECKIN_TIME_FROM']] : null;
        $planCheckinTimeTo           = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CHECKIN_TIME_TO']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CHECKIN_TIME_TO']] : null;
        $planCheckoutTime            = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CHECKOUT_TIME']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CHECKOUT_TIME']] : null;
        $planTaxType                 = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_TAX_TYPE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_TAX_TYPE']] : null;
        $planLimitedQuantity         = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_LIMITED_QUANTITY']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_LIMITED_QUANTITY']] : null;
        $planCancellationPolicy      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CANCELLATION_POLICY']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_CANCELLATION_POLICY']] : null;
        $planMinPerson               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_MIN_PERSON']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_MIN_PERSON']] : null;
        $planMaxPerson               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_MAX_PERSON']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_MAX_PERSON']] : null;
        $planFeeChildHighAccept      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_ACCEPT']] : null;
        $planFeeChildHighCount       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_COUNT']] : null;
        $planFeeChildHighValue       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_VALUE']] : null;
        $planFeeChildHighUnitOption  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_UNIT_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_HIGH_UNIT_OPTION']] : null;
        $planFeeChildLowAccept       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_ACCEPT']] : null;
        $planFeeChildLowCount        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_COUNT']] : null;
        $planFeeChildLowValue        = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_VALUE']] : null;
        $planFeeChildLowUnitOption   = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_UNIT_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_LOW_UNIT_OPTION']] : null;
        $planFeeChildMealSleepAccept = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_ACCEPT']] : null;
        $planFeeChildMealSleepCount  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_COUNT']] : null;
        $planFeeChildMealSleepValue  = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_VALUE']] : null;
        $planFeeChildMealSleepOption = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_SLEEP_OPTION']] : null;
        $planFeeChildMealAccept      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_ACCEPT']] : null;
        $planFeeChildMealCount       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_COUNT']] : null;
        $planFeeChildMealValue       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_VALUE']] : null;
        $planFeeChildMealOption      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_MEAL_OPTION']] : null;
        $planFeeChildSleepAccept     = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_ACCEPT']] : null;
        $planFeeChildSleepCount      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_COUNT']] : null;
        $planFeeChildSleepValue      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_VALUE']] : null;
        $planFeeChildSleepOption     = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_SLEEP_OPTION']] : null;
        $planFeeChildNoneAccept      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_ACCEPT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_ACCEPT']] : null;
        $planFeeChildNoneCount       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_COUNT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_COUNT']] : null;
        $planFeeChildNoneValue       = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_VALUE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_VALUE']] : null;
        $planFeeChildNoneOption      = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_OPTION']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_FEE_CHILD_NONE_OPTION']] : null;
        $planNightStayFrom           = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_NIGHT_STAY_FROM']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_NIGHT_STAY_FROM']] : null;
        $planNightStayTo             = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_NIGHT_STAY_TO']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_NIGHT_STAY_TO']] : null;
        $planUpdatedAt               = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_UPDATED_AT']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_UPDATED_AT']] : null;
        $planUpdateType              = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_UPDATE_TYPE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_UPDATE_TYPE']] : null;
        $planUseType                 = filled($item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_USE_TYPE']]) ? $item[TlLincolnPlan::CSV_ATTRIBUTE_DIFF['PLAN_USE_TYPE']] : null;
        return array(
            $roomStatus,
            $planName,
            $planDescription,
            $planSellTimeFrom,
            $planSellTimeTo,
            $planStartUpload,
            $planEndUpload,
            $planCourseMealBreakfast,
            $planCourseMealDinner,
            $planCourseMealLunch,
            $planAcceptBeforeDays,
            $planAcceptBeforeTime,
            $planCheckinTimeFrom,
            $planCheckinTimeTo,
            $planCheckoutTime,
            $planTaxType,
            $planLimitedQuantity,
            $planCancellationPolicy,
            $planMinPerson,
            $planMaxPerson,
            $planFeeChildHighAccept,
            $planFeeChildHighCount,
            $planFeeChildHighValue,
            $planFeeChildHighUnitOption,
            $planFeeChildLowAccept,
            $planFeeChildLowCount,
            $planFeeChildLowValue,
            $planFeeChildLowUnitOption,
            $planFeeChildMealSleepAccept,
            $planFeeChildMealSleepCount,
            $planFeeChildMealSleepValue,
            $planFeeChildMealSleepOption,
            $planFeeChildMealAccept,
            $planFeeChildMealCount,
            $planFeeChildMealValue,
            $planFeeChildMealOption,
            $planFeeChildSleepAccept,
            $planFeeChildSleepCount,
            $planFeeChildSleepValue,
            $planFeeChildSleepOption,
            $planFeeChildNoneAccept,
            $planFeeChildNoneCount,
            $planFeeChildNoneValue,
            $planFeeChildNoneOption,
            $planNightStayFrom,
            $planNightStayTo,
            $planUpdatedAt,
            $planUpdateType,
            $planUseType
        );
    }

    /**
     * @param array $body
     */
    protected function setBody(array $body = [])
    {
        $commonBody         = [];
        $this->client->body = array_merge($commonBody, $body);
    }

    /**
     * @return void
     */
    public function getMasterHotel()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_master_hotel'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password')
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_master_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'hotels');

        // import to db
        if ($fileContent) {
            $this->importMasterHotel($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV getMasterHotel in S3 failed');
        }
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMasterRoomType()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_master_room_type'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password'),
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_master_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'roomtypes');

        // import to db
        if ($fileContent) {
            $this->importMasterRoomType($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV getMasterRoomType in S3 failed');
        }
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMasterRoomTypeDiff()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_diff_master_room_type'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password'),
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_partial_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'roomtypes_diff');

        // import to db
        if ($fileContent) {
            $this->importMasterRoomTypeDiff($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV getMasterRoomType in S3 failed');
        }
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMasterPlan()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_master_plan'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password'),
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_master_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'plans');

        // import to db
        if ($fileContent) {
            $this->importMasterPlan($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV getMasterRoomType in S3 failed');
        }
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMasterPlanDiff()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_diff_master_plan'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password'),
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_partial_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'plans_diff');

        // import to db
        if ($fileContent) {
            $this->importMasterPlanDiff($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV GetMasterHotel in S3 failed');
        }
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFileCsvEmptyRoom()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_diff_empty_room'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password'),
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_partial_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'empty_rooms');

        // import to db
        if ($fileContent) {
            $this->importCsvEmptyRoom($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV GetMasterHotel in S3 failed');
        }
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFileCsvPlanPrice()
    {
        $queryParams = [
            'fileType'    => config('sc.tllincoln_api.api_file_type_const.file_diff_price_plan'),
            'searchType'  => config('sc.tllincoln_api.api_search_type_const.new'),
            'agtId'       => config('sc.tllincoln_api.agt_id'),
            'agtPassword' => config('sc.tllincoln_api.agt_password'),
        ];

        // set header request
        $this->setHeaders();
        // set body request
        $this->setQueryParams($queryParams);

        $url     = config('sc.tllincoln_api.get_partial_url');
        [$fileName, $responseObj] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        $response = $responseObj['response'] ?? '';
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response, 'plan_prices');

        // import to db
        if ($fileContent) {
            $this->importCsvPlanPrice($fileContent, $responseObj);
        } else {
            \Log::error('Create CSV GetMasterHotel in S3 failed');
        }
    }

    /**
     * @param $content
     * @return bool
     */
    public function isValidResponse($content)
    {
        // check response is text
        return count(str_getcsv($content)) !== 1;
    }

    /**
     * @param $method
     * @param $url
     * @param $query
     * @param $formParams
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest($method, $url, $query, $formParams)
    {
        $isWriteLog = config('sc.is_write_log');
        try {
            $options            = [];
            $options['headers'] = $this->headers;

            if (!is_null($query)) {
                $options['query'] = $query;
            }
            if (!is_null($formParams)) {
                $options['formParams'] = $formParams;
            }

            $client                          = new Client();
            $tlLincolnApiResponse['url']     = $url;
            $tlLincolnApiResponse['method']  = $method;
            $tlLincolnApiResponse['request'] = json_encode($options);
            $response                        = $client->request($method, $url, $options);
        } catch (\Exception $e) {
            \Log::error("API url=$url error: " . $e->getMessage());
            \Log::error($e);
            if ($isWriteLog) {
                $tlLincolnApiResponse['status_code'] = $e->getResponse() ? $e->getResponse()->getStatusCode() : 500;
                $tlLincolnApiResponse['response']    = $e->getMessage();
                $this->writeLogDB($tlLincolnApiResponse);
            }
            return null;
        }
        $fileName                            = null;
        $tlLincolnApiResponse['status_code'] = $response->getStatusCode();
        if ($response->getHeader('Content-Disposition')) {
            $fileName = explode('filename=', $response->getHeader('Content-Disposition')[0])[1];
        }
        $tlLincolnApiResponse['response'] = $response->getBody()->getContents();
        $tlLincolnApiResponse['response'] = trim(
            mb_convert_encoding($tlLincolnApiResponse['response'], "UTF-8", "auto, SJIS-win")
        );
        if ($isWriteLog) {
            $this->writeLogDB($tlLincolnApiResponse);
        }
        return [$fileName, $tlLincolnApiResponse];
    }

    /**
     * @param $fileName
     * @param $csvContent
     * @param $prefixFolderName
     * @return null
     */
    public function uploadS3($fileName, $csvContent = '', $prefixFolderName = '')
    {
        try {
            $fileName = !empty($prefixFolderName) ? "$prefixFolderName/$fileName" : $fileName;
            Storage::disk('tllincoln_s3')->put($fileName, $csvContent);

            return Storage::disk('tllincoln_s3')->get($fileName);
        } catch (\Exception $e) {
            \Log::error('Create file csv in S3 error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterHotel($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            // do something
            try {
                \DB::transaction(function () use ($item) {
                    $tlLincolnHotel = TlLincolnHotel::where('tllincoln_hotel_id', $item[0])->first();
                    if ($tlLincolnHotel) {
                        // mapping tllincoln_hotel_id
                        if ($item[1]) {
                            $tlLincolnHotel->facility_id             = $item[1];
                            $tlLincolnHotel->tllincoln_hotel_name    = $item[2] ?? null;
                            $tlLincolnHotel->tllincoln_hotel_address = $item[3] ?? null;
                            $tlLincolnHotel->tllincoln_hotel_phone   = $item[4] ?? null;
                        } else {
                            $tlLincolnHotel->facility_id             = null;
                            $tlLincolnHotel->tllincoln_hotel_name    = null;
                            $tlLincolnHotel->tllincoln_hotel_address = null;
                            $tlLincolnHotel->tllincoln_hotel_phone   = null;
                        }
                    } else {
                        TlLincolnHotel::create([
                            'tllincoln_hotel_id'      => $item[0],
                            'facility_id'             => $item[1] ?: null,
                            'tllincoln_hotel_name'    => $item[2] ?: null,
                            'tllincoln_hotel_address' => $item[3] ?: null,
                            'tllincoln_hotel_phone'   => $item[4] ?: null,
                        ]);
                    }
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);

        // TODO update mapping hotel from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemHotel($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterRoomType($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            [
                $tlLincolnHotelId,
                $status,
                $code,
                $name,
                $description,
                $minPerson,
                $maxPerson,
                $type,
                $smoking,
                $noSmoking,
                $bus,
                $toilet,
                $internet,
                $imageUrl,
                $imageCaption,
                $imageUpdatedAt,
                $flag,
                $codeOthers,
                $updatedAt
            ] = $this->extractedRoomType($item);

            if (isset($flag) && $flag == TlLincolnRoomType::FLAG['ONLY_SELL_TLLINCOLN']) {
                $status = 0; // inactive
            }

            $searchData = [
                'tllincoln_hotel_id'      => $tlLincolnHotelId,
                'tllincoln_roomtype_code' => $code,
            ];

            $saveData = [
                'tllincoln_hotel_id'                  => $tlLincolnHotelId,
                'tllincoln_roomtype_status'           => $status,
                'tllincoln_roomtype_code'             => $code,
                'tllincoln_roomtype_name'             => $name,
                'tllincoln_roomtype_description'      => $description,
                'tllincoln_roomtype_min_person'       => $minPerson,
                'tllincoln_roomtype_max_person'       => $maxPerson,
                'tllincoln_roomtype_type'             => $type,
                'tllincoln_roomtype_smoking'          => $smoking,
                'tllincoln_roomtype_no_smoking'       => $noSmoking,
                'tllincoln_roomtype_bus'              => $bus,
                'tllincoln_roomtype_toilet'           => $toilet,
                'tllincoln_roomtype_internet'         => $internet,
                'tllincoln_roomtype_image_url'        => $imageUrl,
                'tllincoln_roomtype_image_caption'    => $imageCaption,
                'tllincoln_roomtype_image_updated_at' => $imageUpdatedAt,
                'tllincoln_roomtype_flag'             => $flag,
                'tllincoln_roomtype_code_others'      => $codeOthers,
                'tllincoln_roomtype_updated_at'       => $updatedAt,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnRoomType::updateOrCreate($searchData, $saveData);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);

        // TODO update mapping room from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemRoomType($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterRoomTypeDiff($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            $facilityId = null;
            [
                $tlLincolnHotelId,
                $status,
                $code,
                $name,
                $description,
                $minPerson,
                $maxPerson,
                $type,
                $smoking,
                $noSmoking,
                $bus,
                $toilet,
                $internet,
                $imageUrl,
                $imageCaption,
                $imageUpdatedAt,
                $flag,
                $updateType,
                $codeOthers,
                $updatedAt
            ] = $this->extractedRoomTypeDiff($item);

            if (isset($flag) && $flag == TlLincolnRoomType::FLAG['ONLY_SELL_TLLINCOLN']) {
                $status = 0; // inactive
            }

            $searchData = [
                'tllincoln_hotel_id'      => $tlLincolnHotelId,
                'tllincoln_roomtype_code' => $code,
            ];

            $saveData = [
                'tllincoln_hotel_id'                  => $tlLincolnHotelId,
                'tllincoln_roomtype_status'           => $status,
                'tllincoln_roomtype_code'             => $code,
                'tllincoln_roomtype_name'             => $name,
                'tllincoln_roomtype_description'      => $description,
                'tllincoln_roomtype_min_person'       => $minPerson,
                'tllincoln_roomtype_max_person'       => $maxPerson,
                'tllincoln_roomtype_type'             => $type,
                'tllincoln_roomtype_smoking'          => $smoking,
                'tllincoln_roomtype_no_smoking'       => $noSmoking,
                'tllincoln_roomtype_bus'              => $bus,
                'tllincoln_roomtype_toilet'           => $toilet,
                'tllincoln_roomtype_internet'         => $internet,
                'tllincoln_roomtype_image_url'        => $imageUrl,
                'tllincoln_roomtype_image_caption'    => $imageCaption,
                'tllincoln_roomtype_image_updated_at' => $imageUpdatedAt,
                'tllincoln_roomtype_flag'             => $flag,
                'tllincoln_roomtype_update_type'      => $updateType,
                'tllincoln_roomtype_code_others'      => $codeOthers,
                'tllincoln_roomtype_updated_at'       => $updatedAt,
            ];

            if ($tlLincolnHotelId && $code) {
                try {
                    \DB::transaction(function () use ($searchData, $saveData, $item) {
                        TlLincolnRoomType::updateOrCreate($searchData, $saveData);
                    }, 5);
                } catch (\Exception $e) {
                    \Log::error('Transaction failed: ' . $e->getMessage());
                }
            }
        }

        fclose($streamCSV);

        // TODO update mapping room diff from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemRoomTypeDiff($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterPlan($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            $tlLincolnHotelId = $item[TlLincolnPlan::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']];
            $roomTypeCode     = $item[TlLincolnPlan::CSV_ATTRIBUTE['ROOM_TYPE_CODE']];
            $planId           = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ID']];
            $searchData       = [
                'tllincoln_hotel_id'       => $tlLincolnHotelId,
                'tllincoln_plan_room_code' => $roomTypeCode,
                'tllincoln_plan_id'        => $planId,
            ];

            [
                $roomStatus,
                $planName,
                $planDescription,
                $planSellTimeFrom,
                $planSellTimeTo,
                $planStartUpload,
                $planEndUpload,
                $planCourseMealBreakfast,
                $planCourseMealDinner,
                $planCourseMealLunch,
                $planAcceptBeforeDays,
                $planAcceptBeforeTime,
                $planCheckinTimeFrom,
                $planCheckinTimeTo,
                $planCheckoutTime,
                $planTaxType,
                $planLimitedQuantity,
                $planCancellationPolicy,
                $planMinPerson,
                $planMaxPerson,
                $planFeeChildHighAccept,
                $planFeeChildHighCount,
                $planFeeChildHighValue,
                $planFeeChildHighUnitOption,
                $planFeeChildLowAccept,
                $planFeeChildLowCount,
                $planFeeChildLowValue,
                $planFeeChildLowUnitOption,
                $planFeeChildMealSleepAccept,
                $planFeeChildMealSleepCount,
                $planFeeChildMealSleepValue,
                $planFeeChildMealSleepOption,
                $planFeeChildMealAccept,
                $planFeeChildMealCount,
                $planFeeChildMealValue,
                $planFeeChildMealOption,
                $planFeeChildSleepAccept,
                $planFeeChildSleepCount,
                $planFeeChildSleepValue,
                $planFeeChildSleepOption,
                $planFeeChildNoneAccept,
                $planFeeChildNoneCount,
                $planFeeChildNoneValue,
                $planFeeChildNoneOption,
                $planNightStayFrom,
                $planNightStayTo,
                $planUpdatedAt,
                $planUseType
            ] = $this->extractedPlan($item);
            $saveData = [
                'tllincoln_hotel_id'                         => $tlLincolnHotelId,
                'tllincoln_plan_room_code'                   => $roomTypeCode,
                'tllincoln_plan_room_status'                 => $roomStatus,
                'tllincoln_plan_id'                          => $planId,
                'tllincoln_plan_name'                        => $planName,
                'tllincoln_plan_description'                 => $planDescription,
                'tllincoln_plan_sell_time_from'              => $planSellTimeFrom,
                'tllincoln_plan_sell_time_to'                => $planSellTimeTo,
                'tllincoln_plan_start_upload'                => $planStartUpload,
                'tllincoln_plan_end_upload'                  => $planEndUpload,
                'tllincoln_plan_course_meal_breakfast'       => $planCourseMealBreakfast,
                'tllincoln_plan_course_meal_dinner'          => $planCourseMealDinner,
                'tllincoln_plan_course_meal_lunch'           => $planCourseMealLunch,
                'tllincoln_plan_accept_before_days'          => $planAcceptBeforeDays,
                'tllincoln_plan_accept_before_time'          => $planAcceptBeforeTime,
                'tllincoln_plan_checkin_time_from'           => $planCheckinTimeFrom,
                'tllincoln_plan_checkin_time_to'             => $planCheckinTimeTo,
                'tllincoln_plan_checkout_time'               => $planCheckoutTime,
                'tllincoln_plan_tax_type'                    => $planTaxType,
                'tllincoln_plan_limited_quantity'            => $planLimitedQuantity,
                'tllincoln_plan_cancellation_policy'         => $planCancellationPolicy,
                'tllincoln_plan_min_person'                  => $planMinPerson,
                'tllincoln_plan_max_person'                  => $planMaxPerson,
                'tllincoln_plan_fee_child_high_accept'       => $planFeeChildHighAccept,
                'tllincoln_plan_fee_child_high_count'        => $planFeeChildHighCount,
                'tllincoln_plan_fee_child_high_value'        => $planFeeChildHighValue,
                'tllincoln_plan_fee_child_high_unit_option'  => $planFeeChildHighUnitOption,
                'tllincoln_plan_fee_child_low_accept'        => $planFeeChildLowAccept,
                'tllincoln_plan_fee_child_low_count'         => $planFeeChildLowCount,
                'tllincoln_plan_fee_child_low_value'         => $planFeeChildLowValue,
                'tllincoln_plan_fee_child_low_unit_option'   => $planFeeChildLowUnitOption,
                'tllincoln_plan_fee_child_meal_sleep_accept' => $planFeeChildMealSleepAccept,
                'tllincoln_plan_fee_child_meal_sleep_count'  => $planFeeChildMealSleepCount,
                'tllincoln_plan_fee_child_meal_sleep_value'  => $planFeeChildMealSleepValue,
                'tllincoln_plan_fee_child_meal_sleep_option' => $planFeeChildMealSleepOption,
                'tllincoln_plan_fee_child_meal_accept'       => $planFeeChildMealAccept,
                'tllincoln_plan_fee_child_meal_count'        => $planFeeChildMealCount,
                'tllincoln_plan_fee_child_meal_value'        => $planFeeChildMealValue,
                'tllincoln_plan_fee_child_meal_option'       => $planFeeChildMealOption,
                'tllincoln_plan_fee_child_sleep_accept'      => $planFeeChildSleepAccept,
                'tllincoln_plan_fee_child_sleep_count'       => $planFeeChildSleepCount,
                'tllincoln_plan_fee_child_sleep_value'       => $planFeeChildSleepValue,
                'tllincoln_plan_fee_child_sleep_option'      => $planFeeChildSleepOption,
                'tllincoln_plan_fee_child_none_accept'       => $planFeeChildNoneAccept,
                'tllincoln_plan_fee_child_none_count'        => $planFeeChildNoneCount,
                'tllincoln_plan_fee_child_none_value'        => $planFeeChildNoneValue,
                'tllincoln_plan_fee_child_none_option'       => $planFeeChildNoneOption,
                'tllincoln_plan_night_stay_from'             => $planNightStayFrom,
                'tllincoln_plan_night_stay_to'               => $planNightStayTo,
                'tllincoln_plan_updated_at'                  => $planUpdatedAt,
                'tllincoln_plan_use_type'                    => $planUseType,
                'tllincoln_plan_cancel_id'                   => null,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnPlan::updateOrCreate($searchData, $saveData);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);

        // TODO update mapping plan from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemPlan($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterPlanDiff($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            $tlLincolnHotelId = $item[TlLincolnPlan::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']];
            $roomTypeCode     = $item[TlLincolnPlan::CSV_ATTRIBUTE['ROOM_TYPE_CODE']];
            $planId           = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ID']];
            $searchData       = [
                'tllincoln_hotel_id'       => $tlLincolnHotelId,
                'tllincoln_plan_room_code' => $roomTypeCode,
                'tllincoln_plan_id'        => $planId,
            ];

            [
                $roomStatus,
                $planName,
                $planDescription,
                $planSellTimeFrom,
                $planSellTimeTo,
                $planStartUpload,
                $planEndUpload,
                $planCourseMealBreakfast,
                $planCourseMealDinner,
                $planCourseMealLunch,
                $planAcceptBeforeDays,
                $planAcceptBeforeTime,
                $planCheckinTimeFrom,
                $planCheckinTimeTo,
                $planCheckoutTime,
                $planTaxType,
                $planLimitedQuantity,
                $planCancellationPolicy,
                $planMinPerson,
                $planMaxPerson,
                $planFeeChildHighAccept,
                $planFeeChildHighCount,
                $planFeeChildHighValue,
                $planFeeChildHighUnitOption,
                $planFeeChildLowAccept,
                $planFeeChildLowCount,
                $planFeeChildLowValue,
                $planFeeChildLowUnitOption,
                $planFeeChildMealSleepAccept,
                $planFeeChildMealSleepCount,
                $planFeeChildMealSleepValue,
                $planFeeChildMealSleepOption,
                $planFeeChildMealAccept,
                $planFeeChildMealCount,
                $planFeeChildMealValue,
                $planFeeChildMealOption,
                $planFeeChildSleepAccept,
                $planFeeChildSleepCount,
                $planFeeChildSleepValue,
                $planFeeChildSleepOption,
                $planFeeChildNoneAccept,
                $planFeeChildNoneCount,
                $planFeeChildNoneValue,
                $planFeeChildNoneOption,
                $planNightStayFrom,
                $planNightStayTo,
                $planUpdateType,
                $planUpdatedAt,
                $planUseType
            ] = $this->extractedPlanDiff($item);
            $saveData = [
                'tllincoln_hotel_id'                         => $tlLincolnHotelId,
                'tllincoln_plan_room_code'                   => $roomTypeCode,
                'tllincoln_plan_room_status'                 => $roomStatus,
                'tllincoln_plan_id'                          => $planId,
                'tllincoln_plan_name'                        => $planName,
                'tllincoln_plan_description'                 => $planDescription,
                'tllincoln_plan_sell_time_from'              => $planSellTimeFrom,
                'tllincoln_plan_sell_time_to'                => $planSellTimeTo,
                'tllincoln_plan_start_upload'                => $planStartUpload,
                'tllincoln_plan_end_upload'                  => $planEndUpload,
                'tllincoln_plan_course_meal_breakfast'       => $planCourseMealBreakfast,
                'tllincoln_plan_course_meal_dinner'          => $planCourseMealDinner,
                'tllincoln_plan_course_meal_lunch'           => $planCourseMealLunch,
                'tllincoln_plan_accept_before_days'          => $planAcceptBeforeDays,
                'tllincoln_plan_accept_before_time'          => $planAcceptBeforeTime,
                'tllincoln_plan_checkin_time_from'           => $planCheckinTimeFrom,
                'tllincoln_plan_checkin_time_to'             => $planCheckinTimeTo,
                'tllincoln_plan_checkout_time'               => $planCheckoutTime,
                'tllincoln_plan_tax_type'                    => $planTaxType,
                'tllincoln_plan_limited_quantity'            => $planLimitedQuantity,
                'tllincoln_plan_cancellation_policy'         => $planCancellationPolicy,
                'tllincoln_plan_min_person'                  => $planMinPerson,
                'tllincoln_plan_max_person'                  => $planMaxPerson,
                'tllincoln_plan_fee_child_high_accept'       => $planFeeChildHighAccept,
                'tllincoln_plan_fee_child_high_count'        => $planFeeChildHighCount,
                'tllincoln_plan_fee_child_high_value'        => $planFeeChildHighValue,
                'tllincoln_plan_fee_child_high_unit_option'  => $planFeeChildHighUnitOption,
                'tllincoln_plan_fee_child_low_accept'        => $planFeeChildLowAccept,
                'tllincoln_plan_fee_child_low_count'         => $planFeeChildLowCount,
                'tllincoln_plan_fee_child_low_value'         => $planFeeChildLowValue,
                'tllincoln_plan_fee_child_low_unit_option'   => $planFeeChildLowUnitOption,
                'tllincoln_plan_fee_child_meal_sleep_accept' => $planFeeChildMealSleepAccept,
                'tllincoln_plan_fee_child_meal_sleep_count'  => $planFeeChildMealSleepCount,
                'tllincoln_plan_fee_child_meal_sleep_value'  => $planFeeChildMealSleepValue,
                'tllincoln_plan_fee_child_meal_sleep_option' => $planFeeChildMealSleepOption,
                'tllincoln_plan_fee_child_meal_accept'       => $planFeeChildMealAccept,
                'tllincoln_plan_fee_child_meal_count'        => $planFeeChildMealCount,
                'tllincoln_plan_fee_child_meal_value'        => $planFeeChildMealValue,
                'tllincoln_plan_fee_child_meal_option'       => $planFeeChildMealOption,
                'tllincoln_plan_fee_child_sleep_accept'      => $planFeeChildSleepAccept,
                'tllincoln_plan_fee_child_sleep_count'       => $planFeeChildSleepCount,
                'tllincoln_plan_fee_child_sleep_value'       => $planFeeChildSleepValue,
                'tllincoln_plan_fee_child_sleep_option'      => $planFeeChildSleepOption,
                'tllincoln_plan_fee_child_none_accept'       => $planFeeChildNoneAccept,
                'tllincoln_plan_fee_child_none_count'        => $planFeeChildNoneCount,
                'tllincoln_plan_fee_child_none_value'        => $planFeeChildNoneValue,
                'tllincoln_plan_fee_child_none_option'       => $planFeeChildNoneOption,
                'tllincoln_plan_night_stay_from'             => $planNightStayFrom,
                'tllincoln_plan_night_stay_to'               => $planNightStayTo,
                'tllincoln_plan_updated_at'                  => $planUpdatedAt,
                'tllincoln_plan_use_type'                    => $planUseType,
                'tllincoln_plan_cancel_id'                   => null,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnPlan::updateOrCreate($searchData, $saveData);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);

        // TODO update mapping plan diff from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemPlanDiff($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importCsvEmptyRoom($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            $tlLincolnHotelId = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']];
            $roomTypeCode     = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['ROOM_TYPE_CODE']];
            $sellDate         = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['SELL_DATE']];
            $roomEmpty        = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['ROOM_EMPTY']];
            $flag             = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['FLAG']];
            $updatedAt        = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['UPDATED_AT']];
            $sellStatus       = $item[TlLincolnEmptyRoom::CSV_ATTRIBUTE['SELL_STATUS']];
            $searchData       = [
                'tllincoln_hotel_id'      => $tlLincolnHotelId,
                'tllincoln_roomtype_code' => $roomTypeCode,
            ];

            $saveData = [
                'tllincoln_hotel_id'      => $tlLincolnHotelId,
                'tllincoln_roomtype_code' => $roomTypeCode,
                'tllincoln_sell_date'     => $sellDate,
                'tllincoln_room_empty'    => $roomEmpty,
                'tllincoln_flag'          => $flag,
                'tllincoln_updated_at'    => $updatedAt,
                'tllincoln_sell_status'   => $sellStatus,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnEmptyRoom::updateOrCreate($searchData, $saveData);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);

        // TODO update mapping empty room from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemEmptyRoom($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importCsvPlanPrice($fileContent, $responseObj)
    {
        $csvData   = $this->formatCsvContent($fileContent);
        $streamCSV = fopen('php://memory', 'r+');
        fwrite($streamCSV, trim($csvData));
        rewind($streamCSV);

        while ($item = fgetcsv($streamCSV)) {
            $tlLincolnHotelId        = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']];
            $planId                  = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PLAN_ID']];
            $roomTypeCode            = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['ROOM_TYPE_CODE']];
            $sellDate                = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['SELL_DATE']];
            $remainingQuantity       = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['REMAINING_QUANTITY']];
            $sellStatus              = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['SELL_STATUS']];
            $priceOneAdult           = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_ONE_ADULT']];
            $priceTwoAdults          = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_TWO_ADULTS']];
            $priceThreeAdults        = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_THREE_ADULTS']];
            $priceFourAdults         = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_FOUR_ADULTS']];
            $priceFiveAdults         = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_FIVE_ADULTS']];
            $priceSixAdults          = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_SIX_ADULTS']];
            $priceSevenAdults        = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_SEVEN_ADULTS']];
            $priceEightAdults        = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_EIGHT_ADULTS']];
            $priceNightAdults        = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_NIGHT_ADULTS']];
            $priceForTenAdultsOrMore = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['PRICE_FOR_TEN_ADULTS_OR_MORE']];
            $flag                    = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['FLAG']];
            $updatedAt               = $item[TlLincolnPlanPrice::CSV_ATTRIBUTE['UPDATED_AT']];
            $searchData              = [
                'tllincoln_hotel_id'      => $tlLincolnHotelId,
                'tllincoln_plan_id'       => $planId,
                'tllincoln_roomtype_code' => $roomTypeCode,
            ];

            $saveData = [
                'tlLincoln_hotel_id'                     => $tlLincolnHotelId,
                'tllincoln_plan_id'                      => $planId,
                'tllincoln_roomtype_code'                => $roomTypeCode,
                'tllincoln_sell_date'                    => $sellDate,
                'tllincoln_remaining_quantity'           => $remainingQuantity,
                'tllincoln_sell_status'                  => $sellStatus,
                'tllincoln_price_one_adult'              => $priceOneAdult,
                'tllincoln_price_two_adults'             => $priceTwoAdults,
                'tllincoln_price_three_adults'           => $priceThreeAdults,
                'tllincoln_price_four_adults'            => $priceFourAdults,
                'tllincoln_price_five_adults'            => $priceFiveAdults,
                'tllincoln_price_six_adults'             => $priceSixAdults,
                'tllincoln_price_seven_adults'           => $priceSevenAdults,
                'tllincoln_price_eight_adults'           => $priceEightAdults,
                'tllincoln_price_night_adults'           => $priceNightAdults,
                'tllincoln_price_for_ten_adults_or_more' => $priceForTenAdultsOrMore,
                'tllincoln_flag'                         => $flag,
                'tllincoln_updated_at'                   => $updatedAt,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnPlanPrice::updateOrCreate($searchData, $saveData);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);

        // TODO update mapping plan price from tllincoln to system
        $handlerClass = config('sc.tllincoln.mapping_data_handler');
        $handler      = app($handlerClass);
        $handler->mappingSystemPlanPrice($fileContent, $responseObj);
    }

    /**
     * @param $fileContent
     * @return array|string|string[]
     */
    public function formatCsvContent($fileContent)
    {
        $fileContent = trim(mb_convert_encoding($fileContent, "UTF-8", "auto, SJIS-win"));
        return str_replace('\\', '\\\\', $fileContent);
    }

    /**
     * @param $logData
     * @return void
     */
    public function writeLogDB($logData)
    {
        try {
            ScApiLog::create($logData);
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }
}

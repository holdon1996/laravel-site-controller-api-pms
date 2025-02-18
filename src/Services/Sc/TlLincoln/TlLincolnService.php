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
        $tlLincolnHotelId = $item[TlLincolnRoomType::CSV_ATTRIBUTE['TLLINCOLN_HOTEL_ID']];
        $status           = $item[TlLincolnRoomType::CSV_ATTRIBUTE['STATUS']];
        $code             = $item[TlLincolnRoomType::CSV_ATTRIBUTE['CODE']];
        $name             = $item[TlLincolnRoomType::CSV_ATTRIBUTE['NAME']];
        $description      = $item[TlLincolnRoomType::CSV_ATTRIBUTE['DESCRIPTION']];
        $minPerson        = $item[TlLincolnRoomType::CSV_ATTRIBUTE['MIN_PERSON']];
        $maxPerson        = $item[TlLincolnRoomType::CSV_ATTRIBUTE['MAX_PERSON']];
        $type             = $item[TlLincolnRoomType::CSV_ATTRIBUTE['TYPE']];
        $smoking          = $item[TlLincolnRoomType::CSV_ATTRIBUTE['SMOKING']];
        $noSmoking        = $item[TlLincolnRoomType::CSV_ATTRIBUTE['NO_SMOKING']];
        $bus              = $item[TlLincolnRoomType::CSV_ATTRIBUTE['BUS']] ?? null;
        $toilet           = $item[TlLincolnRoomType::CSV_ATTRIBUTE['TOILET']] ?? null;
        $internet         = $item[TlLincolnRoomType::CSV_ATTRIBUTE['INTERNET']] ?? null;
        $imageUrl         = $item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_URL']] ?? null;
        $imageCaption     = $item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_CAPTION']] ?? null;
        $imageUpdatedAt   = $item[TlLincolnRoomType::CSV_ATTRIBUTE['IMAGE_UPDATED_AT']] ?? null;
        $flag             = $item[TlLincolnRoomType::CSV_ATTRIBUTE['FLAG']] ?? null;
        $updateType       = $item[TlLincolnRoomType::CSV_ATTRIBUTE['UPDATE_TYPE']] ?? null;
        $codeOthers       = $item[TlLincolnRoomType::CSV_ATTRIBUTE['CODE_OTHERS']] ?? null;
        $updatedAt        = $item[TlLincolnRoomType::CSV_ATTRIBUTE['UPDATED_AT']] ?? null;
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
        $roomStatus                  = $item[TlLincolnPlan::CSV_ATTRIBUTE['ROOM_STATUS']];
        $planName                    = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NAME']];
        $planDescription             = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_DESCRIPTION']];
        $planSellTimeFrom            = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_SELL_TIME_FROM']];
        $planSellTimeTo              = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_SELL_TIME_TO']];
        $planStartUpload             = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_START_UPLOAD']];
        $planEndUpload               = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_END_UPLOAD']];
        $planCourseMealBreakfast     = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_BREAKFAST']];
        $planCourseMealDinner        = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_DINNER']];
        $planCourseMealLunch         = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_COURSE_MEAL_LUNCH']];
        $planAcceptBeforeDays        = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ACCEPT_BEFORE_DAYS']];
        $planAcceptBeforeTime        = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_ACCEPT_BEFORE_TIME']];
        $planCheckinTimeFrom         = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKIN_TIME_FROM']];
        $planCheckinTimeTo           = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKIN_TIME_TO']];
        $planCheckoutTime            = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CHECKOUT_TIME']];
        $planTaxType                 = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_TAX_TYPE']];
        $planLimitedQuantity         = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_LIMITED_QUANTITY']];
        $planCancellationPolicy      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_CANCELLATION_POLICY']];
        $planMinPerson               = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_MIN_PERSON']];
        $planMaxPerson               = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_MAX_PERSON']];
        $planFeeChildHighAccept      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_ACCEPT']];
        $planFeeChildHighCount       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_COUNT']];
        $planFeeChildHighValue       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_VALUE']];
        $planFeeChildHighUnitOption  = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_HIGH_UNIT_OPTION']];
        $planFeeChildLowAccept       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_ACCEPT']];
        $planFeeChildLowCount        = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_COUNT']];
        $planFeeChildLowValue        = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_VALUE']];
        $planFeeChildLowUnitOption   = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_LOW_UNIT_OPTION']];
        $planFeeChildMealSleepAccept = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_ACCEPT']];
        $planFeeChildMealSleepCount  = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_COUNT']];
        $planFeeChildMealSleepValue  = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_VALUE']];
        $planFeeChildMealSleepOption = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_SLEEP_OPTION']];
        $planFeeChildMealAccept      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_ACCEPT']];
        $planFeeChildMealCount       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_COUNT']];
        $planFeeChildMealValue       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_VALUE']];
        $planFeeChildMealOption      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_MEAL_OPTION']];
        $planFeeChildSleepAccept     = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_ACCEPT']];
        $planFeeChildSleepCount      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_COUNT']];
        $planFeeChildSleepValue      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_VALUE']];
        $planFeeChildSleepOption     = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_SLEEP_OPTION']];
        $planFeeChildNoneAccept      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_ACCEPT']];
        $planFeeChildNoneCount       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_COUNT']];
        $planFeeChildNoneValue       = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_VALUE']];
        $planFeeChildNoneOption      = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_FEE_CHILD_NONE_OPTION']];
        $planNightStayFrom           = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NIGHT_STAY_FROM']];
        $planNightStayTo             = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_NIGHT_STAY_TO']];
        $planUpdatedAt               = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_UPDATED_AT']];
        $planUseType                 = $item[TlLincolnPlan::CSV_ATTRIBUTE['PLAN_USE_TYPE']];
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importMasterHotel($fileContent);
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importMasterRoomType($fileContent);
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importMasterRoomTypeDiff($fileContent);
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importMasterPlan($fileContent);
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importMasterPlanDiff($fileContent);
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importCsvEmptyRoom($fileContent);
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
        $success = true;
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->client->query_params ?? [], $this->client->body ?? []);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // upload s3
        $fileContent = $this->uploadS3($fileName, $response);

        // import to db
        if ($fileContent) {
            $this->importCsvPlanPrice($fileContent);
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
            \Log::error('command MasterHotelFromTlLincoln error: ' . $e->getMessage());
            \Log::error($e);
            $tlLincolnApiResponse['status_code'] = 500;
            $tlLincolnApiResponse['response']    = $e->getMessage();
            $this->writeLogDB($tlLincolnApiResponse);
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
        $this->writeLogDB($tlLincolnApiResponse);
        return [$fileName, $tlLincolnApiResponse['response']];
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
    public function importMasterHotel($fileContent)
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

                    // TODO update mapping hotel from tllincoln to system
                    $handlerClass = config('sc.tllincoln.mapping_data_handler');
                    $handler      = app($handlerClass);
                    $handler->mappingSystemHotel($item);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterRoomType($fileContent)
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
                $updateType,
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
                    // TODO update mapping room from tllincoln to system
                    $handlerClass = config('sc.tllincoln.mapping_data_handler');
                    $handler      = app($handlerClass);
                    $handler->mappingSystemRoomType($item);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterRoomTypeDiff($fileContent)
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

            if ($tlLincolnHotelId && $code) {
                try {
                    \DB::transaction(function () use ($searchData, $saveData, $item) {
                        TlLincolnRoomType::updateOrCreate($searchData, $saveData);
                        // TODO update mapping room from tllincoln to system
                        $handlerClass = config('sc.tllincoln.mapping_data_handler');
                        $handler      = app($handlerClass);
                        $handler->mappingSystemRoomTypeDiff($item);
                    }, 5);
                } catch (\Exception $e) {
                    \Log::error('Transaction failed: ' . $e->getMessage());
                }
            }
        }

        fclose($streamCSV);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterPlan($fileContent)
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
                'tllincoln_plan_room_code' => $roomCode,
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
                'tllincoln_plan_room_code'                   => $roomCode,
                'tllincoln_plan_room_status'                 => $roomStatus,
                'tllincoln_plan_id'                          => $planId,
                'tllincoln_plan_name'                        => $planName,
                'tllincoln_plan_description'                 => $planDescription,
                'tllincoln_plan_sell_time_from'              => $planSellTimeFrom ?: null,
                'tllincoln_plan_sell_time_to'                => $planSellTimeTo ?: null,
                'tllincoln_plan_start_upload'                => $planStartUpload ?: null,
                'tllincoln_plan_end_upload'                  => $planEndUpload ?: null,
                'tllincoln_plan_course_meal_breakfast'       => $planCourseMealBreakfast,
                'tllincoln_plan_course_meal_dinner'          => $planCourseMealDinner,
                'tllincoln_plan_course_meal_lunch'           => $planCourseMealLunch,
                'tllincoln_plan_accept_before_days'          => $planAcceptBeforeDays,
                'tllincoln_plan_accept_before_time'          => $planAcceptBeforeTime,
                'tllincoln_plan_checkin_time_from'           => $planCheckinTimeFrom,
                'tllincoln_plan_checkin_time_to'             => $planCheckinTimeTo,
                'tllincoln_plan_checkout_time'               => $planCheckoutTime,
                'tllincoln_plan_tax_type'                    => $planTaxType,
                'tllincoln_plan_limited_quantity'            => $planLimitedQuantity !== "" ? $item[28] : null,
                'tllincoln_plan_cancellation_policy'         => $planCancellationPolicy,
                'tllincoln_plan_min_person'                  => $planMinPerson,
                'tllincoln_plan_max_person'                  => $planMaxPerson,
                'tllincoln_plan_fee_child_high_accept'       => $planFeeChildHighAccept,
                'tllincoln_plan_fee_child_high_count'        => $planFeeChildHighCount,
                'tllincoln_plan_fee_child_high_value'        => $planFeeChildHighValue !== "" ? $item[34] : null,
                'tllincoln_plan_fee_child_high_unit_option'  => $planFeeChildHighUnitOption ?: null,
                'tllincoln_plan_fee_child_low_accept'        => $planFeeChildLowAccept,
                'tllincoln_plan_fee_child_low_count'         => $planFeeChildLowCount,
                'tllincoln_plan_fee_child_low_value'         => $planFeeChildLowValue !== "" ? $item[38] : null,
                'tllincoln_plan_fee_child_low_unit_option'   => $planFeeChildLowUnitOption ?: null,
                'tllincoln_plan_fee_child_meal_sleep_accept' => $planFeeChildMealSleepAccept,
                'tllincoln_plan_fee_child_meal_sleep_count'  => $planFeeChildMealSleepCount,
                'tllincoln_plan_fee_child_meal_sleep_value'  => $planFeeChildMealSleepValue !== "" ? $item[42] : null,
                'tllincoln_plan_fee_child_meal_sleep_option' => $planFeeChildMealSleepOption ?: null,
                'tllincoln_plan_fee_child_meal_accept'       => $planFeeChildMealAccept,
                'tllincoln_plan_fee_child_meal_count'        => $planFeeChildMealCount,
                'tllincoln_plan_fee_child_meal_value'        => $planFeeChildMealValue !== "" ? $item[46] : null,
                'tllincoln_plan_fee_child_meal_option'       => $planFeeChildMealOption ?: null,
                'tllincoln_plan_fee_child_sleep_accept'      => $planFeeChildSleepAccept,
                'tllincoln_plan_fee_child_sleep_count'       => $planFeeChildSleepCount,
                'tllincoln_plan_fee_child_sleep_value'       => $planFeeChildSleepValue !== "" ? $item[50] : null,
                'tllincoln_plan_fee_child_sleep_option'      => $planFeeChildSleepOption ?: null,
                'tllincoln_plan_fee_child_none_accept'       => $planFeeChildNoneAccept,
                'tllincoln_plan_fee_child_none_count'        => $planFeeChildNoneCount,
                'tllincoln_plan_fee_child_none_value'        => $planFeeChildNoneValue !== "" ? $item[54] : null,
                'tllincoln_plan_fee_child_none_option'       => $planFeeChildNoneOption ?: null,
                'tllincoln_plan_night_stay_from'             => $planNightStayFrom ?: null,
                'tllincoln_plan_night_stay_to'               => $planNightStayTo ?: null,
                'tllincoln_plan_updated_at'                  => $planUpdatedAt ?: null,
                'tllincoln_plan_use_type'                    => $planUseType,
                'tllincoln_plan_cancel_id'                   => null,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnPlan::updateOrCreate($searchData, $saveData);
                    // TODO update mapping plan from tllincoln to system
                    $handlerClass = config('sc.tllincoln.mapping_data_handler');
                    $handler      = app($handlerClass);
                    $handler->mappingSystemPlan($item);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importMasterPlanDiff($fileContent)
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
                'tllincoln_plan_room_code' => $roomCode,
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
            ] = $this->extractedPlan($item);
            $saveData = [
                'tllincoln_hotel_id'                         => $tlLincolnHotelId,
                'tllincoln_plan_room_code'                   => $roomCode,
                'tllincoln_plan_room_status'                 => $roomStatus,
                'tllincoln_plan_id'                          => $planId,
                'tllincoln_plan_name'                        => $planName,
                'tllincoln_plan_description'                 => $planDescription,
                'tllincoln_plan_sell_time_from'              => $planSellTimeFrom ?: null,
                'tllincoln_plan_sell_time_to'                => $planSellTimeTo ?: null,
                'tllincoln_plan_start_upload'                => $planStartUpload ?: null,
                'tllincoln_plan_end_upload'                  => $planEndUpload ?: null,
                'tllincoln_plan_course_meal_breakfast'       => $planCourseMealBreakfast,
                'tllincoln_plan_course_meal_dinner'          => $planCourseMealDinner,
                'tllincoln_plan_course_meal_lunch'           => $planCourseMealLunch,
                'tllincoln_plan_accept_before_days'          => $planAcceptBeforeDays,
                'tllincoln_plan_accept_before_time'          => $planAcceptBeforeTime,
                'tllincoln_plan_checkin_time_from'           => $planCheckinTimeFrom,
                'tllincoln_plan_checkin_time_to'             => $planCheckinTimeTo,
                'tllincoln_plan_checkout_time'               => $planCheckoutTime,
                'tllincoln_plan_tax_type'                    => $planTaxType,
                'tllincoln_plan_limited_quantity'            => $planLimitedQuantity !== "" ? $item[28] : null,
                'tllincoln_plan_cancellation_policy'         => $planCancellationPolicy,
                'tllincoln_plan_min_person'                  => $planMinPerson,
                'tllincoln_plan_max_person'                  => $planMaxPerson,
                'tllincoln_plan_fee_child_high_accept'       => $planFeeChildHighAccept,
                'tllincoln_plan_fee_child_high_count'        => $planFeeChildHighCount,
                'tllincoln_plan_fee_child_high_value'        => $planFeeChildHighValue !== "" ? $item[34] : null,
                'tllincoln_plan_fee_child_high_unit_option'  => $planFeeChildHighUnitOption ?: null,
                'tllincoln_plan_fee_child_low_accept'        => $planFeeChildLowAccept,
                'tllincoln_plan_fee_child_low_count'         => $planFeeChildLowCount,
                'tllincoln_plan_fee_child_low_value'         => $planFeeChildLowValue !== "" ? $item[38] : null,
                'tllincoln_plan_fee_child_low_unit_option'   => $planFeeChildLowUnitOption ?: null,
                'tllincoln_plan_fee_child_meal_sleep_accept' => $planFeeChildMealSleepAccept,
                'tllincoln_plan_fee_child_meal_sleep_count'  => $planFeeChildMealSleepCount,
                'tllincoln_plan_fee_child_meal_sleep_value'  => $planFeeChildMealSleepValue !== "" ? $item[42] : null,
                'tllincoln_plan_fee_child_meal_sleep_option' => $planFeeChildMealSleepOption ?: null,
                'tllincoln_plan_fee_child_meal_accept'       => $planFeeChildMealAccept,
                'tllincoln_plan_fee_child_meal_count'        => $planFeeChildMealCount,
                'tllincoln_plan_fee_child_meal_value'        => $planFeeChildMealValue !== "" ? $item[46] : null,
                'tllincoln_plan_fee_child_meal_option'       => $planFeeChildMealOption ?: null,
                'tllincoln_plan_fee_child_sleep_accept'      => $planFeeChildSleepAccept,
                'tllincoln_plan_fee_child_sleep_count'       => $planFeeChildSleepCount,
                'tllincoln_plan_fee_child_sleep_value'       => $planFeeChildSleepValue !== "" ? $item[50] : null,
                'tllincoln_plan_fee_child_sleep_option'      => $planFeeChildSleepOption ?: null,
                'tllincoln_plan_fee_child_none_accept'       => $planFeeChildNoneAccept,
                'tllincoln_plan_fee_child_none_count'        => $planFeeChildNoneCount,
                'tllincoln_plan_fee_child_none_value'        => $planFeeChildNoneValue !== "" ? $item[54] : null,
                'tllincoln_plan_fee_child_none_option'       => $planFeeChildNoneOption ?: null,
                'tllincoln_plan_night_stay_from'             => $planNightStayFrom ?: null,
                'tllincoln_plan_night_stay_to'               => $planNightStayTo ?: null,
                'tllincoln_plan_updated_at'                  => $planUpdatedAt ?: null,
                'tllincoln_plan_use_type'                    => $planUseType,
                'tllincoln_plan_cancel_id'                   => null,
            ];

            try {
                \DB::transaction(function () use ($searchData, $saveData, $item) {
                    TlLincolnPlan::updateOrCreate($searchData, $saveData);
                    // TODO update mapping plan from tllincoln to system
                    $handlerClass = config('sc.tllincoln.mapping_data_handler');
                    $handler      = app($handlerClass);
                    $handler->mappingSystemPlanDiff($item);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importCsvEmptyRoom($fileContent)
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
                    // TODO update mapping room from tllincoln to system
                    $handlerClass = config('sc.tllincoln.mapping_data_handler');
                    $handler      = app($handlerClass);
                    $handler->mappingSystemEmptyRoom($item);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);
    }

    /**
     * @param $fileContent
     * @return void
     */
    public function importCsvPlanPrice($fileContent)
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
                    // TODO update mapping room from tllincoln to system
                    $handlerClass = config('sc.tllincoln.mapping_data_handler');
                    $handler      = app($handlerClass);
                    $handler->mappingSystemPlanPrice($item);
                }, 5);
            } catch (\Exception $e) {
                \Log::error('Transaction failed: ' . $e->getMessage());
            }
        }

        fclose($streamCSV);
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

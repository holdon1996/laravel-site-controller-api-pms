<?php

namespace ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln;

use GuzzleHttp\Client;
use ThachVd\LaravelSiteControllerApi\Models\ScApiLog;

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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($queryParams, $response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($queryParams, $response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($queryParams, $response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($queryParams, $response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($queryParams, $response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
        [$fileName, $response] = $this->sendRequest("POST", $url, $this->query_params, $this->body);
        dd($queryParams, $response);
        if (!$this->isValidResponse($response)) {
            \Log::info('not exist file master hotel from TL Lincoln at ' . now());
            return;
        }

        // TODO
        // upload s3
        //$fileContent = $this->s3Upload->process($fileName, $response);

        // import to db
        //if ($fileContent) {
        //    $this->importDB->importMasterHotel($fileContent, $typeTllPointOfSale);
        //} else {
        //    $this->log->error('Create CSV GetMasterHotel in S3 failed');
        //}
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
     * @param $logData
     * @return void
     */
    public function writeLogDB($logData)
    {
        try {
            ScApiLog::create($logData);
        } catch (\Exception $e) {
            dd($e);
            \Log::error($e);
        }
    }
}

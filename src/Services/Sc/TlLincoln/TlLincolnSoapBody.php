<?php

namespace ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln;

use ThachVd\LaravelSiteControllerApi\Services\Sc\Array2Xml\Array2Xml;
use Carbon\Carbon;

/**
 *
 */
class TlLincolnSoapBody
{
    /**
     * @var mixed|string
     */
    public $mainBodyWrapSection;

    /**
     * @param $mainBodyWrapSection
     */
    public function __construct($mainBodyWrapSection = '')
    {
        $this->mainBodyWrapSection = $mainBodyWrapSection;
    }

    /**
     * @return mixed|string
     */
    public function getMainBodyWrapSection()
    {
        return $this->mainBodyWrapSection;
    }

    /**
     * @param $mainBodyWrapSection
     */
    public function setMainBodyWrapSection($mainBodyWrapSection)
    {
        $this->mainBodyWrapSection = $mainBodyWrapSection;
    }

    /**
     * Common request tag
     *
     * @return array[]
     */
    protected function commonRequest($userInfo)
    {
        $nowSystem   = Carbon::now()->format(config('sc.tllincoln_api.date_format')) . 'T' . Carbon::now()->format(
                config('sc.tllincoln_api.system_format_time')
            );
        $agtId       = $userInfo['agtId'] ?? '';
        $agtPassword = $userInfo['agtPassword'] ?? '';

        return [
            'commonRequest' => [
                'agtId'       => $agtId,
                'agtPassword' => $agtPassword,
                'systemDate'  => $nowSystem,
            ],
        ];
    }

    /**
     * @param $section
     * @param $xmlnsType
     * @param $xmlnsVersion
     * @return string
     */
    private function wrapOpenSection($section, $xmlnsType, $xmlnsVersion)
    {
        $xmlnsUrl = $xmlnsVersion['url'];

        return "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:$xmlnsType=\"$xmlnsUrl\"><soapenv:Header/><soapenv:Body><$xmlnsType:$section>";
    }

    /**
     * @param $section
     * @param string $xmlnsType
     * @return string
     */
    private function wrapCloseSection($section, $xmlnsType)
    {
        return "</$xmlnsType:$section></soapenv:Body></soapenv:Envelope>";
    }

    /**
     * @param $section
     * @param $bodyRequest
     * @param $xmlnsType
     * @param $xmlnsVersion
     * @param $userInfo
     * @return string
     */
    public function generateBody($section, $bodyRequest, $xmlnsType, $xmlnsVersion, $userInfo)
    {
        $soapOpenSection  = $this->wrapOpenSection($section, $xmlnsType, $xmlnsVersion);
        $soapCloseSection = $this->wrapCloseSection($section, $xmlnsType);

        $commonRequest = $this->commonRequest($userInfo);
        $bodyRequest   = array_merge($commonRequest, $bodyRequest);
        $bodyContent   = Array2Xml::createXML($this->mainBodyWrapSection, $bodyRequest)->saveXML();
        $bodyContent   = preg_replace("/<\\?xml.*\\?>/", '', $bodyContent, 1);

        return <<<DATA
            $soapOpenSection
                $bodyContent
            $soapCloseSection
        DATA;
    }
}

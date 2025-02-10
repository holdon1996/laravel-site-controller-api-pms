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
     * @param $naifVersion
     * @return string
     */
    private function wrapOpenSection($section, $naifVersion = null)
    {
        if ($naifVersion && $naifVersion == config('sc.tllincoln_api.naif_xml_version.naif_3000')) {
            $xmlnsUrl = 'http://naifc3000.naifc30.nai.lincoln.seanuts.co.jp/';
        } else {
            $xmlnsUrl = 'http://naifc1000.naifc10.nai.lincoln.seanuts.co.jp/';
        }

        return '<soapenv:Envelope xmlns:soapenv=\'http://schemas.xmlsoap.org/soap/envelope/\' xmlns:naif=\'' . $xmlnsUrl . '\'><soapenv:Header/><soapenv:Body><naif:' . $section . '>';
    }

    /**
     * @param $section
     * @return string
     */
    private function wrapCloseSection($section)
    {
        return '</naif:' . $section . '></soapenv:Body></soapenv:Envelope>';
    }

    /**
     * @param $section
     * @param $bodyRequest
     * @param $naifVersion
     * @param $userInfo
     * @return string
     */
    public function generateBody($section, $bodyRequest, $naifVersion = null, $userInfo)
    {
        $soapOpenSection  = $this->wrapOpenSection($section, $naifVersion);
        $soapCloseSection = $this->wrapCloseSection($section);

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

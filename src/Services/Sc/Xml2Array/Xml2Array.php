<?php

namespace ThachVd\LaravelSiteControllerApi\Services\Sc\Xml2Array;

use App\Service\Sc\Xml2Array\Exceptions\IncorrectFormatException;
use DOMDocument;

class Xml2Array
{
    /**
     * Factory create method
     *
     * @param $xml
     * @return mixed
     */
    public static function create($xml)
    {
        return (new static())->convert($xml);
    }

    /**
     * Convert XML to Simple Array
     * @param $xml
     * @return array|array[]|string|string[]
     * @throws IncorrectFormatException
     */
    public static function toArray($xml) {
        return (new static())->convertToArray($xml);
    }

    /**
     * Convert XML to Array
     *
     * @param $xml
     * @return array|string
     * @throws \Exception
     */
    public function convert($xml)
    {
        if (! is_string($xml) || substr(trim($xml), 0, 1) != '<') {
            throw new IncorrectFormatException('XML passed must be a string');
        }

        return new XmlResponse($this->domConvert($xml));
    }

    /**
     * @param $xml
     * Convert XML return simple array
     */
    public function convertToArray($xml) {
        if (! is_string($xml) || substr(trim($xml), 0, 1) != '<') {
            throw new IncorrectFormatException('XML passed must be a string');
        }

        return $this->domConvert($xml);
    }

    /**
     * Convert XML
     *
     * @param $xmlString
     * @return array|string
     */
    protected function domConvert($xmlString)
    {
        $doc = new DOMDocument();
        $doc->loadXML($xmlString);
        $root = $doc->documentElement;
        $output = $this->domnode_to_array($root);
        $output['@root'] = $root->tagName;

        return $output;
    }

    /**
     * Internal conversion for node to array
     *
     * @param $node
     * @return array|string
     */
    protected function domnode_to_array($node)
    {
        $output = array();
        switch ($node->nodeType) {
            case XML_CDATA_SECTION_NODE:
            case XML_TEXT_NODE:
                $output = trim($node->textContent);
                break;
            case XML_ELEMENT_NODE:
                for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
                    $child = $node->childNodes->item($i);
                    $v = $this->domnode_to_array($child);
                    if(isset($child->tagName)) {
                        $t = $child->tagName;
                        if(! isset($output[$t])) {
                            $output[$t] = array();
                        }
                        $output[$t][] = $v;
                    }
                    elseif($v || $v === '0') {
                        $output = (string) $v;
                    }
                }
                if($node->attributes->length && ! is_array($output)) { //Has attributes but isn't an array
                    $output = array('@content'=>$output); //Change output into an array.
                }
                if(is_array($output)) {
                    if($node->attributes->length) {
                        $internalAttributes = [];
                        foreach($node->attributes as $attrName => $attrNode) {
                            $internalAttributes[$attrName] = (string) $attrNode->value;
                        }
                        $output['@attributes'] = $internalAttributes;
                    }
                    foreach ($output as $t => $v) {
                        if(is_array($v) && count($v) == 1 && $t != '@attributes') {
                            $output[$t] = $v[0];
                        }
                    }
                }
                break;
        }
        return $output;
    }
}

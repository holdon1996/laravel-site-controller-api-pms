<?php

namespace ThachVd\LaravelSiteControllerApi\Services\Sc\Array2String;

class Array2String
{
    const NEW_LINE = ",ZZ";

    public function csvFormat($inputArr, $isNewLine = false)
    {
        if (count($inputArr) == 0) {
            return ""; // return Null when inputArr is empty
        }

        $ret = "";
        foreach ($inputArr as $item) {
            if (is_array($item)) {
                foreach ($item as $key => $value) {
                    $ret .= '"' . $value . '",';
                }
                $ret = substr($ret, 0, -1);
                $isNewLine ? $ret .= self::NEW_LINE : $ret .= "\n";
            } else {
                $isNewLine ? ($ret .= $item . self::NEW_LINE) : ($ret .= '"' . $item . '",');
            }
        }
        $isNewLine ? $ret = substr($ret, 0, -3) : $ret = substr($ret, 0, -1);
        return $ret;
    }

    /**
     * Plain csv format without double quote each field
     *
     * @param array $inputArr
     * @param boolean $isNewLine
     * @return string
     */
    public function csvFormatWithoutQuote($inputArr, $isNewLine = false)
    {
        if (count($inputArr) == 0) {
            return "";
        }

        $ret = "";

        foreach ($inputArr as $item) {
            if (is_array($item)) {
                foreach ($item as $key => $value) {
                    $ret .= $value . ',';
                }
                $ret = substr($ret, 0, -1);
                $isNewLine ? $ret .= self::NEW_LINE : $ret .= ',';
            } else {
                $isNewLine ? ($ret .= $item . self::NEW_LINE) : ($ret .= $item . ',');
            }
        }

        $isNewLine ? $ret = substr($ret, 0, -3) : $ret = substr($ret, 0, -1);
        return $ret;
    }
}

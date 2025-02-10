<?php

namespace ThachVd\LaravelSiteControllerApi\Models;

use Illuminate\Database\Eloquent\Model;

class ScTlLincolnSoapApiLog extends Model
{
    protected $table = 'sc_tllincoln_soap_api_logs';
    protected $fillable = [
        'data_id',
        'url',
        'command',
        'is_success',
        'request',
        'response',
        'created_at',
    ];

    public $timestamps = false;

    public static function createLog($data)
    {
        $dataId = self::genDataId();
        return self::create([
            'data_id'    => $dataId,
            'url'   => $data['url'],
            'command'    => $data['command'],
            'is_success' => $data['is_success'],
            'request'    => $data['request'],
            'response'   => $data['response'],
        ]);
    }

    /**
     * Generate 9 digits with count
     *
     * @param int $count
     * @return string
     */
    public static function generate9Digit($count)
    {
        if ($count < 10) {
            return '00000000' . $count;
        }
        if ($count < 100) {
            return '0000000' . $count;
        }
        if ($count < 1000) {
            return '000000' . $count;
        }
        if ($count < 10000) {
            return '00000' . $count;
        }
        if ($count < 100000) {
            return '0000' . $count;
        }
        if ($count < 1000000) {
            return '000' . $count;
        }
        if ($count < 10000000) {
            return '00' . $count;
        }
        if ($count < 100000000) {
            return '0' . $count;
        }

        return $count;
    }

    /**
     * Gen DataId base on count of the db
     *
     * @return string
     */
    public static function genDataId()
    {
        $now    = now();
        $count  = self::whereDate('created_at', $now->toDateString())->count();
        $dataId = self::generate9Digit($count + 1);
        return $now->format('Ymd') . $dataId;
    }
}

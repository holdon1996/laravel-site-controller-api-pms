<?php

namespace ThachVd\LaravelSiteControllerApi\Models;

use Illuminate\Database\Eloquent\Model;

class ScApiLog extends Model
{
    protected $table = 'sc_api_logs';
    protected $fillable = [
        'url',
        'method',
        'request',
        'response',
        'status_code',
        'created_at',
    ];

    public $timestamps = false;
}

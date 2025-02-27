<?php

namespace ThachVd\LaravelSiteControllerApi\Models;

use Illuminate\Database\Eloquent\Model;

class TllincolnAccount extends Model
{
    protected $table = 'tllincoln_accounts';
    protected $fillable = [
        'agt_id',
        'agt_password',
    ];
}

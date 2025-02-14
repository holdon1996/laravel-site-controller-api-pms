<?php

return [
    'disks' => [
        'tllincoln_s3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('TlLINCOLN_AWS_BUCKET'),
        ],
    ],
];

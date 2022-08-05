<?php

namespace App\Utils;

class DataBaseConstants
{
    const ID_TYPE_SIZE = [
        "uid" => [
            "sm" => 6,
            "md" => 9,
            "lg" => 12,
            "xl" => 15,
        ],
        "serial" => [
            "sm" => 2,
            "md" => 3,
            "lg" => 4,
            "xl" => 5,
        ],
        "sku" => [
            "sm" => 6,
            "md" => 9,
            "lg" => 12,
            "xl" => 15,
        ]

    ];

    // todo : V2
    const ID_TYPE_FORMAT = [
        "uid" => [
            "AD" => 6,
            "DA" => 9,
            "lg" => 12,
            "xl" => 15,
        ],
        "serial" => [
            "AD" => 2,
            "DA" => 2,
            "A" => 3,
            "D" => 4,
            "AA" => 5,
        ],
        "sku" => [
            "sm" => 6,
            "md" => 9,
            "lg" => 12,
            "xl" => 15,
        ]
    ];

    const USER_ROLE = [
        "ADMIN" => 1,
        "USER" => 2
    ];

    const USER_KEYWORDS_TYPE = [
        "PREFIX" => 1,
        "SUFFIX" => 2
    ];

    const ARTISAN_TO_CLEAR = [
        "cache", "route", "config", "logs", "view"
    ];

}

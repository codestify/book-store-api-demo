<?php

namespace App\Services\OmniChannel;

use App\Services\OmniChannel\Channels\Amazon;
use App\Services\OmniChannel\Channels\Ebay;

class Manager
{
    protected static $lookUp = [
        'amazon' => Amazon::class,
        'ebay' => Ebay::class,
    ];

    public static function publishOn($markets, $book)
    {
        foreach ($markets as $market) {
           if (in_array($market, array_keys(self::$lookUp))){
               (new self::$lookUp[$market])->list($book);
           }
        }
    }
}

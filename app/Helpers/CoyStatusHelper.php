<?php


namespace App\Helpers;

class CoyStatusHelper
{
    public static function getOptions()
    {
        return [
            '' => 'নির্বাচন করুন',
            'বিএইচকিউ' => 'বিএইচকিউ',
            'সদর' => 'সদর',
            'রেডিও' => 'রেডিও',
            'ওপি' => 'ওপি',
            'আরআর এন্ড লাইন' => 'আরআর এন্ড লাইন',
            '১০১ বিএসসি' => '১০১ বিএসসি',
            '১২১ বিএসসি' => '১২১ বিএসসি',
            '১২২ বিএসসি' => '১২২ বিএসসি',
            '২০৪ এবিএসসি' => '২০৪ এবিএসসি',
            'ইএমই' => 'ইএমই',
        ];
    }
}
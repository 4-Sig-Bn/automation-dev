<?php
//app/Helpers/MaritalStatusHelper.php

namespace App\Helpers;

class MaritalStatusHelper
{
    public static function getOptions()
    {
        return [
            '' => 'নির্বাচন করুন',
            'অবিবাহিত' => 'অবিবাহিত',
            'বিবাহিত' => 'বিবাহিত',
        ];
    }
}

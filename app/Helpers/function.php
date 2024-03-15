<?php


function englishToBengaliDigits($englishNumber) {
    $bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    $englishDigits = range(0, 9);
    
    return str_replace($englishDigits, $bengaliDigits, $englishNumber);
}
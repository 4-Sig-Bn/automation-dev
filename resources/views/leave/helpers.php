<?php


function bn_number($number) {
                    $bn_digits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                    $bn_number = '';
                    $number = (string) $number; // Convert to string to handle each digit individually

                    for ($i = 0; $i < strlen($number); $i++) {
                        $bn_number .= $bn_digits[$number[$i]]; // Append Bengali numeral equivalent
                    }

                    return $bn_number;
}
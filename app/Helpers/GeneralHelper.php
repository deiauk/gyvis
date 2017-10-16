<?php
namespace App\Helpers;

class GeneralHelper
{
    public static function getMonth($month)
    {
        switch($month) {
            case 0:
                return "Sausis";
            case 1:
                return "Vasaris";
            case 2:
                return "Kovas";
            case 3:
                return "Balandis";
            case 4:
                return "Gegužis";
            case 5:
                return "Birželis";
            case 6:
                return "Liepa";
            case 7:
                return "Rugpjūtis";
            case 8:
                return "Rugsėjis";
            case 9:
                return "Spalis";
            case 10:
                return "Lapkritis";
            case 11:
                return "Gruodis";
        }
        return "Blogas skaičius!";
    }
}
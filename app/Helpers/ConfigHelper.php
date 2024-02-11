<?php 

namespace App\Helpers;

use App\Models\Configuration;

class ConfigHelper{

    public static function getAppName() 
    {
        $appName = Configuration::where('type', 'NOM_APPLICATION')->value('valeur');

        return $appName;
    }
}
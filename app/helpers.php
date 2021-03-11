<?php

if(!function_exists('findKey')){
    function findKey($array, $keySearch) : bool{
        foreach ($array as $key => $item) {
            if ($key == $keySearch) {
                return true;
            } elseif (is_array($item) && findKey($item, $keySearch)) {
                return true;
            }
        }
        return false;
    }
}

if(!function_exists('checkForMultipleEntrys')){
    function checkForMultipleEntrys($input) : string{
        if(is_array($input)){
            $input = implode(', ', $input);
            return $input;
        }else{
            return $input;
        }
    }
}


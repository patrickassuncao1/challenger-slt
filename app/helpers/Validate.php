<?php

namespace App\helpers;

class Validate
{
    public static function execute(array $fields)
    {
        $result = [];
        $params = "";

        foreach ($fields as $field => $validate) {
            $result[$field] = strpos($validate, "|")
                ? self::multipleValidations($validate, $field, $params) :
                self::singleValidation($validate, $field, $params);
        }

        if (in_array(false, $result, true)) {

            return false;
        }

        return true;
    }

    public static function singleValidation($validate, $field, $params)
    {
        if (strpos($validate, ":")) {

            [$validate, $params] = explode(":", $validate);
        }

        return Validations::$validate($field, $params);
    }

    public static function multipleValidations($validate, $field, $params)
    {
        $explodePipe = explode('|', $validate);
        $result = [];

        foreach ($explodePipe as $validate) {
            if (strpos($validate, ':')) {
                [$validate, $param] = explode(':', $validate);
                
            }

            $result[$field] =  Validations::$validate($field, $param);

            if ($result[$field] === false || $result[$field] === null) {
                break;
            }
        }

        return $result[$field];
    }
}

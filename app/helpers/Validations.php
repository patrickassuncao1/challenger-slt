<?php

namespace App\helpers;

class Validations
{
    public static function required(string $field)
    {
        if ($_POST[$field] === '' || !isset($_POST[$field])) {
            FlashMessage::setFlash($field, "O campo é obrigatório");
            return false;
        }

        return true;
    }

    public static function maxlen($field, $param)
    {
        $data = $_POST[$field];

        if (strlen($data) > $param) {
            FlashMessage::setFlash($field, "Esse campo não pode passar de {$param} caracteres");
            return false;
        }

        return true;
    }

    public static function file($field, $param)
    {
        $allowedExtensions = explode(",", $param);

        $file = strrchr($_FILES[$field]['name'], '.');

        $file = trim(str_replace(".", "", $file));

        if (!in_array($file, $allowedExtensions, true)) {
            FlashMessage::setFlash($field, "Extensão do arquivo não permitida");
            return false;
        }

        return true;
    }
}

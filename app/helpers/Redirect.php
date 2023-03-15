<?php

namespace App\helpers;

class Redirect
{
    public static function redirect(string $to)
    {
        return header('Location: ' . $to);
    }

    public static function setMessageAndRedirect(string $index, string $message, string $redirectTo)
    {
        FlashMessage::setFlash($index, $message);
        return  self::redirect($redirectTo);
    }

}

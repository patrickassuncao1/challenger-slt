<?php

namespace App\helpers;

class FlashMessage
{
    public static function setFlash(string $index, string $message)
    {
        if (!isset($_SESSION['flash'][$index])) {
            $_SESSION['flash'][$index] = $message;
        }
    }

    public static function getFlash(string $index)
    {
        if (isset($_SESSION['flash'][$index])) {
            $flash = $_SESSION['flash'][$index];
            unset($_SESSION['flash'][$index]);

            return $flash;
        }
    }
}

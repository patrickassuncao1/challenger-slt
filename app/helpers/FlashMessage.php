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

    public static function getFlash(string $index, $isError = false)
    {
        if (isset($_SESSION['flash'][$index])) {
            $flash = $_SESSION['flash'][$index];
            unset($_SESSION['flash'][$index]);

            $classes = $isError ? "text-red-800" : "text-green-800";

            return "<div class='text-sm {$classes}'>
            <span class='font-medium'>
                {$flash}
            </div>";
        }
    }
}

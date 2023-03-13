<?php

return [
    "GET" => [
        "/" => fn () => self::load("HomeController", "index")
    ],
    "POST" => []
];

<?php

return [
    "GET" => [
        "/" => fn () => self::load("HomeController", "index"),
        "/setor" => fn () => self::load("SectorController", "index"),
        "/setor/criar-setor" => fn() => self::load("SectorController", "create")
    ],
    "POST" => [
        "/setor/store" => fn() => self::load("SectorController", "store")
    ]
];

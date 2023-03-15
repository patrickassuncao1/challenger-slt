<?php

return [
    "GET" => [
        "/" => fn () => self::load("DocumentController", "index"),
        "/setor" => fn () => self::load("SectorController", "index"),
        "/setor/criar-setor" => fn () => self::load("SectorController", "create"),
        "/criar-documento" => fn () => self::load("DocumentController", "create"),
        "/documento-tramitacoes/{id}" => fn ($id) => self::load("DocumentController", "getDocumentProcessing", ["id" => $id])
    ],
    "POST" => [
        "/setor/store" => fn () => self::load("SectorController", "store"),
        "/document/store" => fn () => self::load("DocumentController", "store"),
    ]
];

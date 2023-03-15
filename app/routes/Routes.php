<?php

return [
    "GET" => [
        
        "/" => fn () => self::load("DocumentController", "index"),
        
        "/setor" => fn () => self::load("SectorController", "index"),
        
        "/setor/criar-setor" => fn () => self::load("SectorController", "create"),
        
        "/criar-documento" => fn () => self::load("DocumentController", "create"),
        
        "/documento-tramitacoes/{id}" => fn ($id) => self::load("DocumentController", "getDocumentProcessing", ["id" => $id]),
        
        "/enviar-documento/{documentProcessingId}" => fn ($documentProcessingId) =>
        self::load("DocumentProcessingController", "editSectorSend", ["documentProcessingId" => $documentProcessingId]),
        
        "/receber-documento/{documentProcessingId}" => fn ($documentProcessingId) =>
        self::load("DocumentProcessingController", "editSectorReceived", ["documentProcessingId" => $documentProcessingId]),

        "/criar-enviar-documento/{documentId}" => fn ($documentId) => self::load("DocumentProcessingController", "create", ["documentId" => $documentId]),

        "/visualizar-documento/{documentId}" => fn ($documentId) => self::load("DocumentController", "show", ["documentId" => $documentId]),
        "/visualizar-pdf/{documentId}" => fn ($documentId) => self::load("DocumentController", "viewPDF", ["documentId" => $documentId])
    ],
    "POST" => [

        "/setor/store" => fn () => self::load("SectorController", "store"),

        "/document/store" => fn () => self::load("DocumentController", "store"),

        "/document-processing/update-sector-send" => fn () => self::load("DocumentProcessingController", "updateSectorSend"),

        "/document-processing/update-sector-received" => fn () => self::load("DocumentProcessingController", "updateSectorReceived"),

        "/document-processing/create-sector-send" => fn () => self::load("DocumentProcessingController", "store"),
    ]
];

<?php

namespace App\dto;

class DocumentRelationsDto
{
    public int $document_processing_id;
    public int $document_id;
    public ?string $num_document;
    public ?string $sector_send;
    public ?string $datetime_send;
    public ?string $sector_receive;
    public ?string $datetime_received;
}

<?php

namespace App\models;

use App\database\Database;
use DateTime;

class DocumentProcessing
{

    public int $id;
    public int $document_id;
    public int $sector_receive_id;
    public int $sector_send_id;
    public string $datetime_send;
    public string $datetime_received;

    const TABLE_NAME = "document_processing";

    public function create() : int
    {
        $database = new Database(self::TABLE_NAME);

        return $database->insert([
            "document_id" => $this->document_id
        ]);
    }
}

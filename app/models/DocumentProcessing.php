<?php

namespace App\models;

use App\database\Database;
use DateTime;
use PDO;

class DocumentProcessing
{

    public int $id;
    public int $document_id;
    public int $sector_receive_id;
    public int $sector_send_id;
    public string $datetime_send;
    public string $datetime_received;

    const TABLE_NAME = "document_processing";

    public function create(): int
    {
        $database = new Database(self::TABLE_NAME);

        return $database->insert([
            "document_id" => $this->document_id
        ]);
    }


    public function createAndSend(): int
    {
        $database = new Database(self::TABLE_NAME);
        $now = new DateTime();
        $datetime = $now->format('Y-m-d H:i:s');
        
        return $database->insert([
            "document_id" => $this->document_id,
            "sector_send_id" => $this->sector_send_id,
            "datetime_send" =>  $datetime
        ]);
    }

    public static function getDocumentId(int $documentProcessingId)
    {
        $database = new Database(self::TABLE_NAME);

        return $database->select("id = $documentProcessingId", null, null,  "document_id")
            ->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSectorSend()
    {
        $database = new Database(self::TABLE_NAME);

        $now = new DateTime();
        $datetime = $now->format('Y-m-d H:i:s');

        return $database->update("id = {$this->id}", [
            "sector_send_id" => $this->sector_send_id,
            "datetime_send" =>  $datetime
        ]);
    }

    public function updateSectorReceived()
    {
        $database = new Database(self::TABLE_NAME);

        $now = new DateTime();
        $datetime = $now->format('Y-m-d H:i:s');

        return $database->update("id = {$this->id}", [
            "sector_receive_id" => $this->sector_receive_id,
            "datetime_received" => $datetime
        ]);
    }

    public static function findFirst($documentId, $columns)
    {
        $database = new Database(self::TABLE_NAME);

        return $database->select("id = $documentId", null, null,  $columns)
            ->fetch(PDO::FETCH_ASSOC);
    }
}

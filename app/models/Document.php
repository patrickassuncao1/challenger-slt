<?php

namespace App\models;

use App\database\Database;
use App\dto\DocumentRelationsDto;
use PDO;

class Document
{
    public int $id;
    public int $type_document_id;
    public string $num_document;
    public string $title;
    public string $desc_document;
    public string $path_pdf;
    public string $created_at;

    const TABLE_NAME = "documents";

    public function create()
    {
        $database = new Database(self::TABLE_NAME);

        $document_id = $database->insert([
            "type_document_id" => $this->type_document_id,
            "num_document" => $this->num_document,
            "title" => $this->title,
            "desc_document" => $this->desc_document,
            "path_pdf" => $this->path_pdf
        ]);


        $database->__construct("document_processing");

        $database->insert([
            "document_id" => $document_id
        ]);
        
        return $document_id;
    }

    public static function getAll()
    {
        $database = new Database(self::TABLE_NAME);

        return $database->select(null, "created_at", null, "id, num_document, title, created_at")
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function count(int $documentId)
    {
        $database = new Database(self::TABLE_NAME);

        return $database->count("id = $documentId")->fetchColumn();
    }

    public static function getDocumentWithProcessing(int $documentId)
    {
        $tableModel = self::TABLE_NAME;

        $query = "SELECT
                    docp.id AS 'document_processing_id',
                    doc.id AS 'document_id',
                    doc.num_document,
                    doc.title,
                    s1.description as 'sector_send',
                    docp.datetime_send,  
                    s2.description as 'sector_receive',
                    docp.datetime_received
        
                FROM
                    documents doc
                INNER JOIN document_processing docp ON (doc.id = docp.document_id)
                LEFT JOIN sector s1 ON (docp.sector_send_id = s1.id)
                LEFT JOIN sector s2 ON (docp.sector_receive_id = s2.id) 
                WHERE doc.id = 3 ORDER BY docp.id;";

        $database = new Database();

        return $database->dbRaw($query)->fetchAll(PDO::FETCH_CLASS, DocumentRelationsDto::class);;
    }


    public static function findFirst($documentId, $columns)
    {
        $database = new Database(self::TABLE_NAME);

        return $database->select("id = $documentId", null, null,  $columns)
            ->fetch(PDO::FETCH_ASSOC);
    }
}

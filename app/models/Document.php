<?php

namespace App\models;

use App\database\Database;
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

        return $database->insert([
            "type_document_id" => $this->type_document_id,
            "num_document" => $this->num_document,
            "title" => $this->title,
            "desc_document" => $this->desc_document,
            "path_pdf" => $this->path_pdf
        ]);
    }

    public static function getAll()
    {
        $database = new Database(self::TABLE_NAME);

        return $database->select(null, "created_at", null, "id, num_document, title, created_at")
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}

<?php

namespace App\models;

use App\database\Database;
use PDO;

class DocumentType
{
    public int $id;
    public string $desc_document_type;

    const TABLE_NAME = "document_type";

    public static function getAll()
    {

        $database = new Database(self::TABLE_NAME);

        return $database->select()->fetchAll(PDO::FETCH_CLASS, self::class);

    }
}

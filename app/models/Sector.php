<?php

namespace App\models;

use App\database\Database;
use PDO;

class Sector
{
    public int $id;
    public string $sigla;
    public string $description;
    public string $created_at;

    const TABLE_NAME = "sector";

    public function create()
    {
        $database = new Database(self::TABLE_NAME);

        $sectorId = $database->insert([
            "sigla" => $this->sigla,
            "description" => $this->description,
        ]);

        $this->id = $sectorId;

        return $this->id;
    }

    public static function getAll()
    {
        $database = new Database(self::TABLE_NAME);

        return $database->select(null, "created_at")->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function count(int $sectorId)
    {
        $database = new Database(self::TABLE_NAME);

        return $database->count("id = $sectorId")->fetchColumn();
    }

}

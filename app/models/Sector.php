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

    public function create()
    {
        $database = new Database("sector");

        $sectorId = $database->insert([
            "sigla" => $this->sigla,
            "description" => $this->description,
        ]);

        $this->id = $sectorId;

        return $this->id;
    }

    public static function getAll()
    {
        $database = new Database("sector");

        return $database->select(null, "created_at")->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}

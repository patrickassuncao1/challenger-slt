<?php

namespace App\controller;

use App\helpers\Redirect;
use App\models\Sector;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::getAll();

        self::view('sector', ["sectors" => $sectors]);
    }

    public function create()
    {
        self::view('create_sector');
    }

    public function store($request)
    {
        $sector = new Sector();
        $sector->description = $request->description;
        $sector->sigla = $request->sigla;
        $sector->create();

        Redirect::setMessageAndRedirect("message", "Setor Criado com sucesso", "/setor/criar-setor");
    }
}

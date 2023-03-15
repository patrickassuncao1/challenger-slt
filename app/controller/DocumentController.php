<?php

namespace App\controller;

use App\helpers\FlashMessage;
use App\helpers\Redirect;
use App\helpers\Validate;
use App\models\Document;
use App\models\DocumentType;

class DocumentController extends Controller
{

    public function index() 
    {
        $documents = Document::getAll();

        self::view('home', ["documents" => $documents]);
    }

    public function create()
    {
        $documentTypes = DocumentType::getAll();

        self::view('create_document', ["documentTypes" => $documentTypes]);
    }

    public function store($request)
    {

        $validate = Validate::execute([
            "num_document" => "required",
            "title" => "required|maxlen:40",
            "type_document_id" => "required",
            "desc_document" => "required|maxlen:255",
            "file" => "file:pdf"
        ]);

        if (!$validate) {
            return Redirect::redirect("/criar-documento");
        }

        $random_name = md5(uniqid(rand(), true));
        $pathPdf = "/resources/storage/". $random_name . '.pdf';
        $destination =  dirname(__FILE__, 3) . $pathPdf;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

            FlashMessage::setFlash("error", "Error ao envia o documento");

            return  Redirect::redirect("/criar-documento");
        }

        $document = new Document();
        $document->num_document = $request->num_document;
        $document->title = $request->title;
        $document->type_document_id = $request->type_document_id;
        $document->desc_document = $request->desc_document;
        $document->path_pdf = $pathPdf;

        $document->create();
        

        return Redirect::redirect("/");
    }
}

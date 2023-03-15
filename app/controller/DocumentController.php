<?php

namespace App\controller;

use App\helpers\FlashMessage;
use App\helpers\Redirect;
use App\helpers\Response;
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
        $pathPdf = "/resources/storage/" . $random_name . '.pdf';
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


    public function getDocumentProcessing(object $request, object $params)
    {
        $id = $params->id;

        if (!is_numeric($id)) {
            return self::view('not_found', [], 404);
        }

        $countDocument = Document::count($id);

        if (!$countDocument) {
            return self::view('not_found', [], 404);
        }

        $procedures = Document::getDocumentWithProcessing($id);

        $document =  Document::findFirst($id, "id, num_document, title");

        self::view('procedure', ["document" => $document, "procedures" => $procedures]);
    }

    public function show(object $request, object $params)
    {
        $documentId = $params->documentId;

        if (!is_numeric($documentId)) {
            return self::view('not_found', [], 404);
        }

        $document = Document::documentWithType($documentId);

        if (!$document) {
            return self::view('not_found', [], 404);
        }

        self::view("view_document",  ["document" => $document]);
    }

    public function viewPDF(object $request, object $params)
    {
        $documentId = $params->documentId;

        if (!is_numeric($documentId)) {
            return self::view('not_found', [], 404);
        }

        $document = Document::findFirst($documentId, "path_pdf");

        if (!$document) {
            return self::view('not_found', [], 404);
        }

        $path = dirname(__FILE__, 3). "{$document['path_pdf']}";
        
        $base = base64_encode(file_get_contents($path, false));


        return new Response(200, base64_decode($base), "application/pdf");
        
        
    }
}

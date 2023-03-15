<?php

namespace App\controller;

use App\helpers\Redirect;
use App\helpers\Validate;
use App\models\Document;
use App\models\DocumentProcessing;
use App\models\Sector;

class DocumentProcessingController extends Controller
{
    public function editSectorSend(object $request, object $params)
    {
        $documentProcessingId = $params->documentProcessingId;

        if (!is_numeric($documentProcessingId)) {
            return self::view('not_found', [], 404);
        }

        $baseDocumentProcessing = DocumentProcessing::getDocumentId($documentProcessingId);

        if (!$baseDocumentProcessing) {
            return self::view('not_found', [], 404);
        }

        $document = Document::findFirst($baseDocumentProcessing['document_id'], "id, num_document, title");

        $sectors = Sector::getAll();

        self::view('send_document', [
            "sectors" => $sectors,
            "document" => $document,
            "documentProcessingId" =>  $documentProcessingId
        ]);
    }

    public function updateSectorSend(object $request)
    {
        $validate = Validate::execute([
            "sector_id" => "required",
            "document_processing_id" => "required"
        ]);

        if (!$validate) {
            return Redirect::redirect($_SERVER['HTTP_REFERER']);
        }

        $countSector = Sector::count((int)$request->sector_id);
        $documentProcessingId = $request->document_processing_id;

        if (!$countSector) {
            return Redirect::setMessageAndRedirect("error", "sector não encotrado", $_SERVER['HTTP_REFERER']);
        }

        $dbDocumentProcessing = DocumentProcessing::findFirst((int)$documentProcessingId, "*");

        if ($dbDocumentProcessing['sector_send_id'] && !$dbDocumentProcessing["sector_receive_id"]) {

            return Redirect::setMessageAndRedirect("error", "determinado setor não recebeu arquivo", $_SERVER['HTTP_REFERER']);
        }

        if ($dbDocumentProcessing["sector_receive_id"]) {
            return Redirect::setMessageAndRedirect("error", "Rota errada", $_SERVER['HTTP_REFERER']);
        }

        $documentProcessing = new DocumentProcessing();
        $documentProcessing->id = $request->document_processing_id;
        $documentProcessing->sector_send_id = $request->sector_id;
        $documentProcessing->updateSectorSend();

        return Redirect::setMessageAndRedirect(
            "update",
            "Documento Enviado com sucesso",
            "/documento-tramitacoes/{$dbDocumentProcessing["document_id"]}"
        );
    }

    public function editSectorReceived(object $request, object $params)
    {
        $documentProcessingId = $params->documentProcessingId;

        if (!is_numeric($documentProcessingId)) {
            return self::view('not_found', [], 404);
        }

        $baseDocumentProcessing = DocumentProcessing::getDocumentId($documentProcessingId);

        if (!$baseDocumentProcessing) {
            return self::view('not_found', [], 404);
        }

        $document = Document::findFirst($baseDocumentProcessing['document_id'], "id, num_document, title");

        $sectors = Sector::getAll();

        self::view('received_document', [
            "sectors" => $sectors,
            "document" => $document,
            "documentProcessingId" =>  $documentProcessingId
        ]);
    }

    public function updateSectorReceived(object $request)
    {
        $validate = Validate::execute([
            "sector_id" => "required",
            "document_processing_id" => "required"
        ]);

        if (!$validate) {
            return Redirect::redirect($_SERVER['HTTP_REFERER']);
        }

        $countSector = Sector::count((int)$request->sector_id);
        $documentProcessingId = $request->document_processing_id;

        if (!$countSector) {
            return Redirect::setMessageAndRedirect("error", "sector não encotrado", $_SERVER['HTTP_REFERER']);
        }

        $dbDocumentProcessing = DocumentProcessing::findFirst((int)$documentProcessingId, "*");

        if (!$dbDocumentProcessing['sector_send_id'] || $dbDocumentProcessing['sector_receive_id']) {
            return Redirect::setMessageAndRedirect("error", "Esse arquivo não foi enviado ou completado", $_SERVER['HTTP_REFERER']);
        } else if ($dbDocumentProcessing['sector_send_id'] === $request->sector_id) {
            return Redirect::setMessageAndRedirect("error", "Seu setor acabou de enviar este arquivo, então não pode receber", $_SERVER['HTTP_REFERER']);
        }

        $documentProcessing = new DocumentProcessing();
        $documentProcessing->id = $request->document_processing_id;
        $documentProcessing->sector_receive_id = $request->sector_id;
        $documentProcessing->updateSectorReceived();

        return Redirect::setMessageAndRedirect(
            "update",
            "Documento Recebido com sucesso",
            "/documento-tramitacoes/{$dbDocumentProcessing["document_id"]}"
        );
    }


    public function create(object $request, object $params)
    {   
        $documentId = $params->documentId;

        if (!is_numeric( $documentId )) {
            return self::view('not_found', [], 404);
        }

        $document = Document::findFirst($documentId, "id, num_document, title");

        if (!$document) {
            return self::view('not_found', [], 404);
        }

        $sectors = Sector::getAll();

        self::view('send_create_document', [
            "sectors" => $sectors,
            "document" => $document
        ]);
    }

    public function store(object $request)
    {

        $validate = Validate::execute([
            "sector_id" => "required",
            "document_id" => "required"
        ]);

        if (!$validate) {
            return Redirect::redirect($_SERVER['HTTP_REFERER']);
        }

        $documentId = (int) $request->document_id;

        $document = Document::count($documentId);

        if (!$document) {
            return self::view('not_found', [], 404);
        }

        $countSector = Sector::count((int)$request->sector_id);

        if (!$countSector) {
            return Redirect::setMessageAndRedirect("error", "sector não encotrado", $_SERVER['HTTP_REFERER']);
        }

        $documentProcessing = new DocumentProcessing();
        $documentProcessing->document_id = $documentId;
        $documentProcessing->sector_send_id = $request->sector_id;
        $documentProcessing->createAndSend();


        return Redirect::setMessageAndRedirect(
            "update",
            "Documento Enviado com sucesso",
            "/documento-tramitacoes/{$documentId}"
        );
    }
}

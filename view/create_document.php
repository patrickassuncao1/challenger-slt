<?php

use App\helpers\FlashMessage;

$this->layout('master');

?>

<section class="container block mx-auto mt-8 mb-20">
    <div class="px-2 sm:px-4">
        <h1 class="text-3xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
            Criar Documento
        </h1>
        <form action="/document/store" method="POST" enctype="multipart/form-data">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="num_document" class="block mb-2 text-sm font-medium text-gray-900">Número do documento</label>
                    <input type="number" id="num_document" name="num_document" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Número" required>
                    <?php echo FlashMessage::getFlash("num_document", true); ?>
                </div>
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Título</label>
                    <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Título" required>
                    <?php echo FlashMessage::getFlash("title", true); ?>
                </div>
                <div>
                    <label for="type_document_id" class="block mb-2 text-sm font-medium text-gray-900">Tipo do documento</label>
                    <select id="type_document_id" name="type_document_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Selecione uma opção</option>
                        <?php foreach ($documentTypes as $documentType) : ?>
                            <option value="<?php echo $documentType->id  ?>"><?php echo $documentType->desc_document_type ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php echo FlashMessage::getFlash("type_document_id", true); ?>
                </div>
            </div>
            <div class="mb-6">
                <label for="desc_document" class="block mb-2 text-sm font-medium text-gray-900">Descrição do documento</label>
                <textarea id="desc_document" name="desc_document" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Deescreva aqui..." required></textarea>
                <?php echo FlashMessage::getFlash("desc_document", true); ?>
            </div>
            <div class="mb-6 max-w-xs">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload (PDF)</label>
                <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="application/pdf" aria-describedby="file_input_help" id="file_input" type="file" required />
                <?php echo FlashMessage::getFlash("file", true); ?>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Salvar</button>
        </form>
    </div>
</section>
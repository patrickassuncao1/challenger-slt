<?php

use App\helpers\FlashMessage;

$this->layout('master');

$message = FlashMessage::getFlash("error", true);

?>

<section class="container block mx-auto mt-8">
    <div class="px-2 sm:px-4">
        <h1 class="text-3xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
            Receber Documento
        </h1>
        <p class="leading-none text-gray-900 text-base font-medium">
            N° documento: <?php echo $document['num_document'] ?>
        </p>
        <p class="leading-none mt-4 text-gray-900 text-base font-medium">
            Título do documento: <?php echo $document['title'] ?>
        </p>

        <div class="max-w-2xl mt-8">
            <?php
            if ($message) {
                echo $message;
            };

            ?>
            <form action="/document-processing/update-sector-received" method="post" class="w-full">
                <div>
                    <label for="sector_id" class="block mb-4 text-sm font-medium text-gray-900">Qual o seu setor ?</label>
                    <select id="sector_id" name="sector_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Selecione uma opção</option>
                        <?php foreach ($sectors as $sector) : ?>
                            <option value="<?php echo $sector->id  ?>"><?php echo $sector->description ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php echo FlashMessage::getFlash("sector_id", true); ?>
                    <input type="hidden" value="<?php echo $documentProcessingId ?>" name="document_processing_id" />
                </div>
                <button type="submit" class="text-white mt-8 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Atualizar</button>
            </form>
        </div>
    </div>
</section>
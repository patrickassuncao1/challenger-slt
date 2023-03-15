<?php

use App\helpers\FlashMessage;

$this->layout('master');

$message = FlashMessage::getFlash("update");

$countProcedures = count($procedures);

?>

<section class="container block mx-auto mt-8 mb-20">
    <?php
    if ($message) {
        echo $message;
    };

    ?>
    <div class="px-2 sm:px-4">
        <div class="flex gap-20 items-center w-full justify-between">
            <div>
                <h2 class="text-2xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl">
                    Tramitações
                </h2>
                <p class="leading-none text-gray-900 text-base font-medium">
                    N° documento: <?php echo $document['num_document'] ?>
                </p>
                <p class="leading-none mt-4 text-gray-900 text-base font-medium">
                    Título do documento: <?php echo $document['title'] ?>
                </p>
            </div>
            <div class="block">
                <a href="/visualizar-documento/<?php echo $document['id'] ?> " class="text-white mt-8 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Visualizar Documento</a>
            </div>
        </div>

        <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg bg-gray-200">
            <table class="w-full text-sm text-left text-gray-600 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-5 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            N° Documento
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Título
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Setor de Envio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data/hora Envio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Setor Recebeu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data/hora Recebeu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($procedures as $key => $procedure) : ?>
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <?php echo $procedure->num_document  ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $procedure->title  ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $procedure->sector_send   ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $procedure->datetime_send ?
                                    date('d/m/Y H:i', strtotime($procedure->datetime_send)) : ""; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $procedure->sector_receive   ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $procedure->datetime_received ?
                                    date('d/m/Y H:i', strtotime($procedure->datetime_received)) : ""; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <?php if ((!$procedure->sector_send || $procedure->sector_receive) && $countProcedures === ($key + 1)) : ?>

                                    <?php $urlSend = $procedure->sector_receive ?
                                        "/criar-enviar-documento/{$procedure->document_id}"
                                        : "/enviar-documento/{$procedure->document_processing_id}"; ?>

                                    <a href="<?php echo $urlSend ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Enviar</a>

                                <?php endif ?>
                                <?php if ($procedure->sector_send && !$procedure->sector_receive) : ?>
                                    <span class="mx-2">/</span>
                                    <a href="/receber-documento/<?php echo $procedure->document_processing_id ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Receber</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</section>
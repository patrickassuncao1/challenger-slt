<?php

use App\helpers\FlashMessage;

$this->layout('master');

$message = FlashMessage::getFlash("message");

?>

<section class="container block mx-auto mt-8">
    <div class="px-2 sm:px-4">
        <h1 class="text-3xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
            Criar Setor
        </h1>
        <div class="max-w-2xl">
            <?php
                if ($message) {
                    echo $message;
                };

            ?>
            <form action="/setor/store" method="post" class="w-full">
                <div class="mb-6">
                    <label for="sigla" class="block mb-2 text-sm font-medium text-gray-900">Sigla</label>
                    <input type="text" id="sigla" name="sigla" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="sigla" required>
                </div>
                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descrição</label>
                    <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="descrição">
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Salvar</button>
            </form>
        </div>
    </div>
</section>
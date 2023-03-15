<?php $this->layout('master') ?>

<section class="container block mx-auto mt-8 mb-20">

    <div class="px-2 sm:px-4">
        <h1 class="text-3xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
            Gerenciador de documentos
        </h1>
        <div className="w-full mb-4">
            <a href="/criar-documento" class="relative inline-block shrink-0 rounded-md bg-blue-700 px-12 py-3 text-sm font-medium text-white transition hover:bg-blue-400  focus:outline-none focus:ring">
                Novo documento
            </a>
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
                        <th>
                            Criado em:
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documents as $document) : ?>
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <?php echo $document->num_document ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $document->title ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo date('d/m/Y', strtotime($document->created_at)); ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/documento-tramitacoes/<?php echo $document->id; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tramitações</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
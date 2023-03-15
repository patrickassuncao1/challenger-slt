<?php $this->layout('master'); ?>

<section class="container block mx-auto mt-8 mb-20">
    <div class="px-2 sm:px-4 mt-4">
        <h1 class="text-3xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
            Documento
        </h1>
        <p class="leading-none text-gray-900 text-base font-medium">
            N° documento: <?php echo $document['num_document'] ?>
        </p>
        <p class="leading-none mt-4 text-gray-900 text-base font-medium">
            Título do documento: <?php echo $document['title'] ?>
        </p>
        <p class="leading-none mt-4 text-gray-900 text-base font-medium">
            Criado em: <?php echo date('d/m/Y H:i', strtotime($document['created_at'])) ?>
        </p>
        <p class="leading-none mt-4 text-gray-900 text-base font-medium">
            Descrição do documento: <?php echo $document['desc_document'] ?>
        </p>
        <p class="leading-none mt-4 text-gray-900 text-base font-medium">
            Tipo do documento: <?php echo $document['desc_document_type'] ?>
        </p>

        <div class="mt-8">
            <a href="/visualizar-pdf/<?php echo $document['id'] ?>" target="_blank" rel="noreferrer"  class="text-white mt-8 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Visualizar PDF</a>
        </div>
    </div>
</section>
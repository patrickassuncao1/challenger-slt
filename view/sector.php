<?php $this->layout('master'); ?>

<section class="container block mx-auto mt-8 mb-20">
    <div class="px-2 sm:px-4">
        <h1 class="text-3xl my-4 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
            Setores
        </h1>
        <div className="w-full mb-4">
            <a href="/setor/criar-setor" class="relative inline-block shrink-0 rounded-md bg-blue-700 px-12 py-3 text-sm font-medium text-white transition hover:bg-blue-400  focus:outline-none focus:ring">
                Criar Setor
            </a>
        </div>
        <?php if (count($sectors) > 0) : ?>
            <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg bg-gray-200">
                <table class="w-full text-sm text-left text-gray-600 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-5 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sigla
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descrição
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Data de criação
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sectors as $sector) : ?>

                            <tr class="bg-white border-b  hover:bg-gray-50  ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <?php echo $sector->id; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $sector->sigla; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $sector->description; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo date('d/m/Y H:i:s', strtotime($sector->created_at)); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="mt-4">Nenhum setor encontrado</p>
        <?php endif; ?>
    </div>
</section>
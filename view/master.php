<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/public/img/avatar.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Desafio</title>
</head>

<body>
    <header>
        <nav class="border-gray-200 px-2 sm:px-4 py-2.5 bg-gray-900">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <a href="/" class="flex items-center">
                    <img src="/public/img/avatar.png" class="h-10 mr-3" alt="Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Patrick</span>
                </a>
                <div class="w-auto" id="navbar-default">
                    <ul class="flex p-4 rounded-lg flex-row md:space-x-8  md:text-sm md:font-medium">
                        <li>
                            <a href="/" class="block rounded bg-transparent text-blue-700 p-0">Home</a>
                        </li>
                        <li>
                            <a href="/setor" class="block rounded bg-transparent text-blue-700 p-0">Setor</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?= $this->section('content') ?>
</body>

</html>
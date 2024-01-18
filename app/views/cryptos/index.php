<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="https://cdn.example.com/path/to/flowbite.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.5.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com/"></script>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
    </style>
    <title><?php echo SITENAME; ?></title>
    <title>nexusCrypto</title>
</head>

<body>
<nav class=" border-gray-800 px-4 lg:px-6 py-2.5 bg-gray-800 fixed z-50 w-screen">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="<?php echo URLROOT; ?>" class="flex items-center">
            <img src="https://cryptoz.iamabdus.com/v1.1/wp-content/uploads/2021/11/cryptoz-logo-1.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
            <?php echo SITENAME; ?>
        </a>
        <div class="flex items-center lg:order-2">
            <?php if (isset($_SESSION['UserID'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout" class="text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 hover:bg-gray-700 focus:outline-none focus:ring-gray-800">Logout</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login" class="text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 hover:bg-gray-700 focus:outline-none focus:ring-gray-800">Log in</a>
                <a href="<?php echo URLROOT; ?>/users/register" class="text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">Register</a>
                <button id="mobile-menu-button" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="<?php echo URLROOT; ?>" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:p-0 text-white" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/watchlists/index" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 text-gray-400 lg:hover:text-white hover:bg-gray-700 hover:text-white lg:hover:bg-transparent border-gray-700">Watchlist</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/cryptos/portfolio" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 text-gray-400 lg:hover:text-white hover:bg-gray-700 hover:text-white lg:hover:bg-transparent border-gray-700">Portfolio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <main class="grid grid-cols-1 lg:grid-cols-3 bg-gradient-to-tl from-[#10413f] to-[#1e2738] pt-16">
        <div class="col-span-1 lg:col-span-3 justify-self-center w-[90%] my-12">
            <div
                    class="w-96 bg-gray-800 p-6 rounded-md shadow-md flex items-center justify-between mb-4 lg:mb-0 carousel carousel-center p-4 w-full space-x-8 bg-neutral mx-4 rounded-box">
                <?php foreach ($data['topten'] as $topten) {
                    ?>
                    <div class="carousel-item flex flex-row gap-8">
                        <div class="flex flex-col rounded-box">
                            <h2
                                    class="text-2xl font-bold mb-2 text-white"><?php echo "{$topten['name']} ({$topten['symbol']})"; ?></h2>
                            <div class="flex items-center">
                                <span
                                        class="text-lg font-semibold <?php echo ($topten['quote']['USD']['percent_change_24h'] > 0) ? 'text-green-500' : 'text-red-500'; ?> mr-2">
                                    <?php echo ($topten['quote']['USD']['percent_change_24h'] > 0) ? '+' : ''; ?><?php echo $topten['quote']['USD']['percent_change_24h']; ?>%
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     class="h-6 w-6 <?php echo ($topten['quote']['USD']['percent_change_24h'] > 0) ? 'text-green-500' : 'text-red-500'; ?>">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <img
                                src="https://s2.coinmarketcap.com/static/img/coins/128x128/<?php echo $topten['id']?>.png"
                                alt="<?php echo $topten['name']; ?> Logo" class="h-8 w-8">
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php foreach ($data['cryptoData'] as $crypto) {
            $logoUrl = "https://s2.coinmarketcap.com/static/img/coins/128x128/{$crypto['id']}.png";
            $ringColorClass = ($crypto['quote']['USD']['percent_change_24h'] >= 0) ? 'ring-success' : 'ring-error';
            ?>
            <div class="swap swap-flip relative cursor-default m-4">
                <label for="coveringCheckbox-<?php echo $crypto['slug']; ?>" class="absolute inset-0"></label>
                <input type="checkbox" class="absolute inset-0 z-40"
                       id="coveringCheckbox-<?php echo $crypto['slug']; ?>">
                <div
                        class="card card-compact bg-base-100 px-8 py-4 shadow-xl swap-off">
                    <div class="flex items-center">
                        <div class="avatar">
                            <div
                                    class="w-24 rounded-full ring <?php echo $ringColorClass; ?> ring-offset-base-100 ring-offset-2">
                                <img src="<?php echo $logoUrl; ?>" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <h1
                                    class="m-auto font-bold text-xl text-white"><?php echo $crypto['name']; ?></h1>
                            <div class="flex flex-row gap-2">
                                <p
                                        class="text-sm text-white font-semibold"><?php echo $crypto['symbol']; ?></p>
                                <p class="text-sm text-white font-semibold">•</p>
                                <span
                                        class="text-sm font-semibold <?php echo ($crypto['quote']['USD']['percent_change_24h'] >= 0 ? 'text-green-500' : 'text-red-500'); ?> mr-2">
                                    <?php echo $crypto['quote']['USD']['percent_change_24h']; ?>%
                                </span>
                            </div>
                            <div>
                                <p
                                        class="text-sm font-bold text-green-500">$<?php echo round($crypto['quote']['USD']['price'], 5); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $crypto['name']; ?></h2>
                        <p>Rank: <?php echo $crypto['cmc_rank']; ?></p>
                        <p>Market Cap: $<?php echo number_format($crypto['quote']['USD']['market_cap']); ?></p>
                        <p>Volume 24h: $<?php echo number_format($crypto['quote']['USD']['volume_24h']); ?></p>
                        <p>Circulating Supply: <?php echo number_format($crypto['circulating_supply']); ?>
                            <?php echo $crypto['symbol']; ?></p>
                        <p>Total Supply: <?php echo number_format($crypto['total_supply']); ?>
                            <?php echo $crypto['symbol']; ?></p>
                        <div class="card-actions justify-end z-50">
                            <form method="post" action="<?php echo URLROOT?>/watchlists/addToWatchlist">
                                <input type="hidden" name="cryptoID" value="<?= $crypto['id'] ?>">
                                <input type="hidden" name="userID" value="<?= $_SESSION['UserID'] ?>">
                                <button type="submit" name="Submit" class="btn btn-success"><i class="fa-regular fa-star"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div
                        class="card card-compact bg-base-100 px-8 py-4 shadow-xl swap-on flex flex-col">
                    <div class="avatar m-auto">
                        <div
                                class="w-36 rounded-full ring <?php echo $ringColorClass; ?> ring-offset-base-100 ring-offset-2">
                            <img src="<?php echo $logoUrl; ?>" />
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-xl text-white"><?php echo $crypto['name']; ?></h1>
                        <p class="text-sm text-white font-semibold"><?php echo $crypto['symbol']; ?></p>
                    </div>
                </div>
            </div>

        <?php } ?>

    </main>


<script src="<?php echo URLROOT; ?>/public/js/main.js"></script>
</body>
</html>

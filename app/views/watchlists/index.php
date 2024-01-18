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
                    <a href="<?php echo URLROOT; ?>/cryptos" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 text-gray-400 lg:hover:text-white hover:bg-gray-700 hover:text-white lg:hover:bg-transparent border-gray-700" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/watchlists/index" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:p-0 text-white">Watchlist</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/cryptos/portfolio" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 text-gray-400 lg:hover:text-white hover:bg-gray-700 hover:text-white lg:hover:bg-transparent border-gray-700">Portfolio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<main class="grid grid-cols-3 bg-gradient-to-tl from-[#10413f] to-[#1e2738] pt-16">
    <?php
    foreach ($data['watchlistIds'] as $cryptoID) {
        $id = $cryptoID->CryptoID;

        foreach ($data['watchlists'] as $watchlist)

        if (isset($watchlist[$id])) {
            $crypto = $watchlist[$id];
            $name = $crypto['name'];
            $symbol = $crypto['symbol'];
            $priceChangePercent24h = $crypto['quote']['USD']['percent_change_24h'];
            $rank = $crypto['cmc_rank'];
            $marketCap = $crypto['quote']['USD']['market_cap'];
            $volume24h = $crypto['quote']['USD']['volume_24h'];
            $circulatingSupply = $crypto['circulating_supply'];
            $totalSupply = $crypto['total_supply'];
            $slug = $crypto['slug'];
            $price = $crypto['quote']['USD']['price'];

            $logoUrl = "https://s2.coinmarketcap.com/static/img/coins/128x128/$id.png";
            $ringColorClass = ($priceChangePercent24h >= 0) ? 'ring-success' : 'ring-error';
            ?>
            <div class="swap swap-flip relative cursor-default m-4 items-center">
                <label for="coveringCheckbox-<?php echo $slug; ?>" class="absolute inset-0"></label>
                <input type="checkbox" class="absolute inset-0 z-40" id="coveringCheckbox-<?php echo $slug; ?>">
                <div class="card card-compact bg-base-100 px-8 py-4 shadow-xl swap-off">
                    <div class="flex items-center">
                        <div class="avatar">
                            <div class="w-24 rounded-full ring <?php echo $ringColorClass; ?> ring-offset-base-100 ring-offset-2">
                                <img src="<?php echo $logoUrl; ?>" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <h1 class="m-auto font-bold text-xl text-white"><?php echo $name; ?></h1>
                            <div class="flex flex-row gap-2">
                                <p class="text-sm text-white font-semibold"><?php echo $symbol; ?></p>
                                <p class="text-sm text-white font-semibold">•</p>
                                <span class="text-sm font-semibold <?php echo ($priceChangePercent24h >= 0 ? 'text-green-500' : 'text-red-500'); ?> mr-2">
                                <?php echo $priceChangePercent24h; ?>%
                            </span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-green-500">$<?php echo $price; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <h2 class="card-title"><?php echo $name; ?></h2> -->
                        <!-- <p>Rank: <?php echo $rank; ?></p>
                    <p>Market Cap: $<?php echo number_format($marketCap); ?></p>
                    <p>Volume 24h: $<?php echo number_format($volume24h); ?></p>
                    <p>Circulating Supply: <?php echo number_format($circulatingSupply); ?> <?php echo $symbol; ?></p>
                    <p>Total Supply: <?php echo number_format($totalSupply); ?> <?php echo $symbol; ?></p> -->
                        <div class="card-actions justify-end z-50">
                            <button class="btn btn-success" onclick="modal_<?php echo $id?>.showModal()">Show more</button>
                        </div>
                    </div>
                </div>
                <div class="card card-compact bg-base-100 px-8 py-4 shadow-xl swap-on flex flex-col">
                    <div class="avatar m-auto">
                        <div class="w-36 rounded-full ring <?php echo $ringColorClass; ?> ring-offset-base-100 ring-offset-2">
                            <img src="<?php echo $logoUrl; ?>" />
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-xl text-white"><?php echo $name; ?></h1>
                        <p class="text-sm text-white font-semibold"><?php echo $symbol; ?></p>
                    </div>
                </div>
            </div>

            <dialog id="modal_<?php echo $id?>" class="modal modal-bottom sm:modal-middle">
                <div class="relative cursor-default m-4">
                    <div class="card card-compact bg-base-100 px-8 py-4 shadow-xl">
                        <div class="flex items-center">
                            <div class="avatar">
                                <div class="w-24 rounded-full ring <?php echo $ringColorClass; ?> ring-offset-base-100 ring-offset-2">
                                    <img src="<?php echo $logoUrl; ?>" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <h1 class="m-auto font-bold text-xl text-white"><?php echo $name; ?></h1>
                                <div class="flex flex-row gap-2">
                                    <p class="text-sm text-white font-semibold"><?php echo $symbol; ?></p>
                                    <p class="text-sm text-white font-semibold">•</p>
                                    <span class="text-sm font-semibold <?php echo ($priceChangePercent24h >= 0 ? 'text-green-500' : 'text-red-500'); ?> mr-2">
                                <?php echo $priceChangePercent24h; ?>%
                            </span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-green-500">$<?php echo $price; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $name; ?></h2>
                            <p>Rank: <?php echo $rank; ?></p>
                            <p>Market Cap: $<?php echo number_format($marketCap); ?></p>
                            <p>Volume 24h: $<?php echo number_format($volume24h); ?></p>
                            <p>Circulating Supply: <?php echo number_format($circulatingSupply); ?> <?php echo $symbol; ?></p>
                            <p>Total Supply: <?php echo number_format($totalSupply); ?> <?php echo $symbol; ?></p>
                            <form method="dialog" class = "flex flex-row gap-4">
                                <button class="btn">Close</button>
                                <a href="<?php echo  URLROOT?>/watchlists/delete/<?php echo $id; ?>" class = "btn bg-red-500 text-black hover:bg-red-900">Remove from Watchlist</a>
                            </form>
                        </div>
                    </div>
                </div>
            </dialog>
            <?php } ?>
    <?php } ?>


</main>

<script src="<?php echo URLROOT; ?>/public/js/main.js"></script>
</body>
</html>
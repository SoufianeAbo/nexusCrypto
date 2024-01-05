<!DOCTYPE html>
<html lang="en" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>

<div>
<?php 
require '../app/config/config.php';
require APPROOT . '/views/inc/navbar.php';
 ?> 
 </div>

<main class="grid grid-cols-3 bg-gradient-to-tl from-[#10413f] to-[#1e2738] pt-16">
<?php
foreach ($cryptoData['data'] as $crypto) {
    $name = $crypto['name'];
    $symbol = $crypto['symbol'];
    $priceChangePercent24h = $crypto['quote']['USD']['percent_change_24h'];
    $rank = $crypto['cmc_rank'];
    $marketCap = $crypto['quote']['USD']['market_cap'];
    $volume24h = $crypto['quote']['USD']['volume_24h'];
    $circulatingSupply = $crypto['circulating_supply'];
    $totalSupply = $crypto['total_supply'];
    $slug = $crypto['slug'];
    $id = $crypto['id'];
    $price = round($crypto['quote']['USD']['price'], 5);
    

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
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                        <button class = "btn bg-red-500 text-black hover:bg-red-900">Remove from Watchlist</button>
                    </form>
                </div>
            </div>
</div>
</dialog>
<?php } ?>

</main>
</body>
</html>
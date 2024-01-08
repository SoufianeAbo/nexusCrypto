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

<main class="grid grid-cols-1 lg:grid-cols-3 bg-gradient-to-tl from-[#10413f] to-[#1e2738] pt-16">
<div class="col-span-1 lg:col-span-3 justify-self-center w-[90%] my-12">
    <div class="w-96 bg-gray-800 p-6 rounded-md shadow-md flex items-center justify-between mb-4 lg:mb-0 carousel carousel-center p-4 w-full space-x-8 bg-neutral mx-4 rounded-box">
        <?php foreach ($toptenData['data'] as $topten) {
            $name = $topten['name'];
            $symbol = $topten['symbol'];
            $priceChangePercent24h = $topten['quote']['USD']['percent_change_24h'];
            $rank = $topten['cmc_rank'];
            $marketCap = $topten['quote']['USD']['market_cap'];
            $volume24h = $topten['quote']['USD']['volume_24h'];
            $circulatingSupply = $topten['circulating_supply'];
            $totalSupply = $topten['total_supply'];
            $slug = $topten['slug'];
            $id = $topten['id'];
            $price = round($topten['quote']['USD']['price'], 5);
        ?>
            <div class="carousel-item flex flex-row gap-8">
                <div class = "flex flex-col rounded-box">
                <h2 class="text-2xl font-bold mb-2 text-white"><?php echo "$name ($symbol)"; ?></h2>
                <div class="flex items-center">
                    <span class="text-lg font-semibold <?php echo ($priceChangePercent24h > 0) ? 'text-green-500' : 'text-red-500'; ?> mr-2">
                        <?php echo ($priceChangePercent24h > 0) ? '+' : ''; ?><?php echo $priceChangePercent24h; ?>%
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 <?php echo ($priceChangePercent24h > 0) ? 'text-green-500' : 'text-red-500'; ?>">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                </div>
                <img src="https://s2.coinmarketcap.com/static/img/coins/128x128/<?php echo $topten['id']?>.png" alt="<?php echo $name; ?> Logo" class="h-8 w-8">
            </div>
        <?php } ?>
    </div>
</div>

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
        <div class="swap swap-flip relative cursor-default m-4">
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
                    <h2 class="card-title"><?php echo $name; ?></h2>
                    <p>Rank: <?php echo $rank; ?></p>
                    <p>Market Cap: $<?php echo number_format($marketCap); ?></p>
                    <p>Volume 24h: $<?php echo number_format($volume24h); ?></p>
                    <p>Circulating Supply: <?php echo number_format($circulatingSupply); ?> <?php echo $symbol; ?></p>
                    <p>Total Supply: <?php echo number_format($totalSupply); ?> <?php echo $symbol; ?></p>
                    <div class="card-actions justify-end z-50">
                        <button class="btn btn-success"><i class="fa-regular fa-star"></i></button>
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

<?php } ?>

</main>
</body>
</html>
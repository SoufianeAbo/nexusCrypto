<!DOCTYPE html>
<html lang="en" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-d2qEGTPBxGJ1lhMzuMz3YxjhI9dBp6gDSycv9R0om6JhFdqem1Ay+g/IiUkMu9ED6tE/Q2GDD11QdQZgtA5O6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class = "grid grid-cols-3 bg-gradient-to-tl from-[#10413f] to-[#1e2738]">

<?php

// Your CoinMarketCap API key
$apiKey = 'c8328ac7-3c86-4a07-baec-8d7a6728e626';

// CoinMarketCap API endpoint for cryptocurrency listings
$endpoint = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

// Set up cURL options
$ch = curl_init($endpoint . '?start=1&limit=100');  // Adjust parameters as needed
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-CMC_PRO_API_KEY: ' . $apiKey,
    'Accept: application/json',
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
    // Handle the error accordingly
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check if the response was successful
if ($data && isset($data['status']) && $data['status']['error_code'] === 0) {
    // Iterate through each cryptocurrency
    foreach ($data['data'] as $crypto) {
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

        // Construct the logo URL
        $logoUrl = "https://s2.coinmarketcap.com/static/img/coins/128x128/$id.png";

        // Determine the color for the ring based on price change
        $ringColorClass = ($priceChangePercent24h >= 0) ? 'ring-success' : 'ring-error';

        // Print the HTML card using multiple echo statements
        echo '<div class="swap swap-flip relative cursor-default m-4">';
        echo '<label for="coveringCheckbox-' . $slug . '" class="absolute inset-0"></label>';
        echo '<input type="checkbox" class="absolute inset-0 z-50" id="coveringCheckbox-' . $slug . '">';
        echo '<div class="card card-compact bg-base-100 px-8 py-4 shadow-xl swap-off">';
        echo '<div class="flex items-center">';
        echo '<div class="avatar">';
        echo '<div class="w-24 rounded-full ring ' . $ringColorClass . ' ring-offset-base-100 ring-offset-2">';
        echo '<img src="' . $logoUrl . '" />';
        echo '</div>';
        echo '</div>';
        echo '<div class="ml-4">';
        echo '<h1 class="m-auto font-bold text-xl text-white">' . $name . '</h1>';
        echo '<div class="flex flex-row gap-2">';
        echo '<p class="text-sm text-white font-semibold">' . $symbol . '</p>';
        echo '<p class="text-sm text-white font-semibold">•</p>';
        echo '<span class="text-sm font-semibold ' . ($priceChangePercent24h >= 0 ? 'text-green-500' : 'text-red-500') . ' mr-2">';
        echo $priceChangePercent24h . '%';
        echo '</span>';
        echo '</div>';
        echo '<div>';
        echo "<p class='text-sm font-bold text-green-500'>$$price</p>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h2 class="card-title">' . $name . '</h2>';
        echo '<p>Rank: ' . $rank . '</p>';
        echo '<p>Market Cap: $' . number_format($marketCap) . '</p>';
        echo '<p>Volume 24h: $' . number_format($volume24h) . '</p>';
        echo '<p>Circulating Supply: ' . number_format($circulatingSupply) . ' ' . $symbol . '</p>';
        echo '<p>Total Supply: ' . number_format($totalSupply) . ' ' . $symbol . '</p>';
        echo '<div class="card-actions justify-end">';
        echo '<button class="btn btn-success">Show more</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="card card-compact bg-base-100 px-8 py-4 shadow-xl swap-on flex flex-col">';
        echo '<div class="avatar m-auto">';
        echo '<div class="w-36 rounded-full ring ' . $ringColorClass . ' ring-offset-base-100 ring-offset-2">';
        echo '<img src="' . $logoUrl . '" />';
        echo '</div>';
        echo '</div>';
        echo '<div class = "flex flex-col">';
        echo "<h1 class = 'font-bold text-xl text-white'>$name</h1>";
        echo "<p class='text-sm text-white font-semibold'>$symbol</p>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
} else {
    // Handle the API error
    echo 'API error: ' . $data['status']['error_message'];
}

?>

</body>
</html>

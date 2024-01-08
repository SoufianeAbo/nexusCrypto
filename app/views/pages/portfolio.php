<!DOCTYPE html>
<html lang="en" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>

<div>
    <?php 
    require '../app/config/config.php';
    require APPROOT . '/views/inc/navbar.php';
    $balance = 0;
    ?> 
</div>

<?php
foreach ($portfolioData as $portfolio) {
  $balance += $portfolio['Quantity'] * $cryptoData[$portfolio['CryptoID']]['quote']['USD']['price'];
}
?>

<main class="flex flex-col justify-around bg-gradient-to-tl from-[#10413f] to-[#1e2738] pt-16">
    <div class="flex flex-row w-full justify-around">
        <div class="flex flex-col m-4">
            <div class="card w-96 h-64 bg-base-100 shadow-xl h-36">
                <div class="card-body flex items-center justify-center">
                    <h2 class="card-title text-white text-3xl">Balance</h2>
                    <p class="text-white text-6xl mt-6">$<?php echo round($balance, 2) ?></p>
                </div>
            </div>

            <div class="flex flex-row justify-around mt-16">
                <button class="btn bg-[#BC9B49] text-black w-24">Buy</button>
                <button class="btn bg-[#BC9B49] text-black w-24">Sell</button>
                <button class="btn bg-[#BC9B49] text-black w-24">Transfer</button>
            </div>
        </div>

        <canvas class="bg-base-100 card shadow-xl m-4 p-4 rounded" id="myPieChart" width="400" height="400"></canvas>
    </div>

    <div class="overflow-x-auto mx-[10%]">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Value</th>
                    <th>Coin Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($portfolioData as $portfolio) {
                    $name = $cryptoData[$portfolio['CryptoID']]['name'];
                    $symbol = $cryptoData[$portfolio['CryptoID']]['symbol'];
                    $quantity = $portfolio['Quantity'];
                    $price = round($cryptoData[$portfolio['CryptoID']]['quote']['USD']['price'], 5);
                    $finalPrice = $price * $quantity;
                    $logoUrl = "https://s2.coinmarketcap.com/static/img/coins/128x128/{$cryptoData[$portfolio['CryptoID']]['id']}.png";
                    $ringColorClass = ($cryptoData[$portfolio['CryptoID']]['quote']['USD']['percent_change_24h'] >= 0) ? 'ring-success' : 'ring-error';

                    $chartLabels[] = $name;
                    $chartData[] = $quantity;
                    ?>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="<?php echo $logoUrl; ?>" alt="Avatar Tailwind CSS Component" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold"><?php echo $name; ?></div>
                                    <div class="text-sm opacity-50"><?php echo $symbol; ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo '$' . $finalPrice; ?></td>
                        <td><?php echo '$' . $price; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    // Dynamic data for the pie chart based on PHP data
    const dynamicData = {
        labels: <?php echo json_encode($chartLabels); ?>,
        data: <?php echo json_encode($chartData); ?>,
    };

    // Get the canvas element
    const ctx = document.getElementById('myPieChart').getContext('2d');

    // Create a pie chart with dynamic data
    const myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: dynamicData.labels,
            datasets: [{
                data: dynamicData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                ],
                borderWidth: 1,
            }],
        },
        options: {
            responsive: false,
            legend: {
                position: 'bottom',
            },
        },
    });
</script>
</body>
</html>

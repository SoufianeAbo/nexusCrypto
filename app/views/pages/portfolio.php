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
 ?> 
 </div>

<main class="flex flex-col justify-around bg-gradient-to-tl from-[#10413f] to-[#1e2738] pt-16">
    <div class = "flex flex-row w-full justify-around">
        <div class = "flex flex-col m-4">
            <div class="card w-96 h-64 bg-base-100 shadow-xl h-36">
                <div class="card-body flex items-center justify-center">
                    <h2 class="card-title text-white text-3xl">Balance</h2>
                    <p class = "text-white text-6xl mt-6">$6,000.00</p>
                </div>
            </div>

            <div class = "flex flex-row justify-around mt-16">
                <button class="btn bg-[#BC9B49] text-black w-24">Buy</button>
                <button class="btn bg-[#BC9B49] text-black w-24">Sell</button>
                <button class="btn bg-[#BC9B49] text-black w-24">Transfer</button>
            </div>
        </div>

        <canvas class = "bg-base-100 card shadow-xl m-4 p-4 rounded" id="myPieChart" width="400" height="400"></canvas>
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
                $finalprice = $price * 2;
                
            
                $logoUrl = "https://s2.coinmarketcap.com/static/img/coins/128x128/$id.png";
                $ringColorClass = ($priceChangePercent24h >= 0) ? 'ring-success' : 'ring-error';
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
                <td>
                2
                </td>
                <td><?php echo $finalprice; ?></td>
                <td>
                <?php echo $price; ?>
                </td>
            </tr>
            <?php } ?>
            </tbody>
            
        </table>
        </div>
</main>



<script>
// Static example data for the pie chart
const staticData = {
  labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5'],
  data: [25, 20, 15, 10, 30]
};

// Get the canvas element
const ctx = document.getElementById('myPieChart').getContext('2d');

// Create a pie chart
const myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: staticData.labels,
    datasets: [{
      data: staticData.data,
      backgroundColor: [
        'rgba(255, 99, 132, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(255, 206, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(153, 102, 255, 0.7)',
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: false, // Disable responsiveness for simplicity
    legend: {
      position: 'bottom',
    }
  }
});
</script>
</body>
</html>
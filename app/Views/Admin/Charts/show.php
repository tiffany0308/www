<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Charts<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title is-2">Charts</h1>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .chart-container {
        width: 600px;
        height: 600px;
        margin: 0 auto;
    }

    .chart-container-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
        justify-items: center;
        margin: 100px;
    }
</style>
</head>
<body>
<div class="chart-container">
    <h2 class="title">Tag Distribution</h2>
    <canvas id="tagDistributionChart"></canvas>
</div>

<div class="chart-container-container">
    <div class="chart-container">
        <h2 class="title">Average Ratings by Tag</h2>
        <canvas id="averageRatingsByTagChart"></canvas>
    </div>

    <div class="chart-container">
        <h2 class="title">Top 5 Events with Highest Ratings</h2>
        <canvas id="topEventsChart"></canvas>
    </div>
</div>

<script>
    var tagDistributionData = JSON.parse('<?= $tagDistribution ?>');
    var averageRatingsByTagData = JSON.parse('<?= $averageRatingsByTag ?>');
    var topEventsData = JSON.parse('<?= $topEvents ?>');

    var tagDistributionChart = new Chart(document.getElementById('tagDistributionChart'), {
        type: 'pie',
        data: {
            labels: tagDistributionData.labels,
            datasets: [{
                data: tagDistributionData.data,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 159, 64)',
                    'rgb(153, 102, 255)',
                    'rgb(100, 234, 234)',
                    'rgb(255, 127, 249)',
                    'rgb(255, 205, 0)',
                    'rgb(255, 214, 243)',
                    'rgb(0, 153, 255)',
                    'rgb(181, 255, 195)',
                    'rgb(238, 157, 140)'
                ],
            }],
        }
    });

    var averageRatingsByTagChart = new Chart(document.getElementById('averageRatingsByTagChart'), {
        type: 'bar',
        data: {
            labels: averageRatingsByTagData.labels,
            datasets: [{
                label: 'Average Ratings',
                data: averageRatingsByTagData.data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }],
        }
    });

    var topEventsChart = new Chart(document.getElementById('topEventsChart'), {
        type: 'bar',
        data: {
            labels: topEventsData.labels,
            datasets: [{
                label: 'Average Ratings',
                data: topEventsData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
            }],
        }
    });
</script>
<?= $this->endSection() ?>
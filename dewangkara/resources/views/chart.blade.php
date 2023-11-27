<!DOCTYPE html>
<html>
<head>
    <title>Monthly Recap Chart</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
</head>
<body>
    <h2>Monthly Recap Chart</h2>
    <canvas id="monthlyChart" width="400" height="200"></canvas>

<div style="width: 80%;">
    {!! $chart->container() !!}
</div>

{!! $chart->script() !!}

</body>
</html>


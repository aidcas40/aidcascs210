<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci Series</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php
    if(isset($_POST['generate_series'])) {
        $iterations = (int)$_POST['iterations'];
        
        // Check if input is negative
        if($iterations < 0) {
            echo "Error: Number of iterations must be a positive integer.";
        } else {
            // Calculate Fibonacci series
            $fibonacci_series = array(0);
            if($iterations > 1) {
                $fibonacci_series[1] = 1;
                for($i = 2; $i < $iterations; $i++) {
                    $fibonacci_series[$i] = $fibonacci_series[$i-1] + $fibonacci_series[$i-2];
                }
            }
            
            // Output result as graph
            $labels = range(1, $iterations);
            $data = $fibonacci_series;
            $chart_data = array(
                'labels' => $labels,
                'datasets' => array(
                    array(
                        'label' => 'Fibonacci Number',
                        'data' => $data,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'borderWidth' => 1
                    )
                )
            );
            ?>
            <div style="width: 50%;">
                <canvas id="chart"></canvas>
            </div>
            <script>
                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: <?php echo json_encode($chart_data); ?>
                });
            </script>
            <?php
        }
    }
    ?>

    <form method="post">
        <label>Number of iterations:</label>
        <input type="number" name="iterations" required>
        <button type="submit" name="generate_series">Generate Series</button>
    </form>
</body>
</html>

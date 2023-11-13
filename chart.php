<!DOCTYPE html>
<html>

<head>
    <title>Weather Station</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Liên kết đến tệp CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .title {
            color: #9e0915;
        }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="title">
            <h2>Visualization Techniques</h2>
        </div>
        <!-- <div id="real-time-clock"></div>
        <script type="text/javascript">
            function updateRealTimeClock() {
                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();
                var day = currentTime.getDate();
                var month = currentTime.getMonth() + 1; // Lưu ý: Tháng trong JavaScript bắt đầu từ 0
                var year = currentTime.getFullYear();
                // Xác định AM hoặc PM
                var ampm = hours >= 12 ? 'PM' : 'AM';

                // Đổi định dạng giờ từ 24 giờ sang 12 giờ
                hours = hours % 12;
                hours = hours ? hours : 12; // Nếu giờ là 0, thì sẽ là 12 giờ

                var timeString = day + "/" + month + "/" + year + " " + hours + ":" + minutes + ":" + seconds + " " + ampm;
                document.getElementById("real-time-clock").innerHTML = "Current date and time: " + timeString;
            }

            // Cập nhật thời gian mỗi giây
            setInterval(updateRealTimeClock, 1000);
        </script> -->
        <?php
        include 'database.php';
        $time = [];
        $temperature_1 = [];
        $humidity_1 = [];
        $air_quality_1 = [];
        $temperature_2 = [];
        $humidity_2 = [];
        $air_quality_2 = [];
        $pdo = Database::connect();
        $sql = 'SELECT * FROM esp32_table_record ORDER BY date, time';
        foreach ($pdo->query($sql) as $row) {
            $temperature_1[] = $row['temperature_1'];
            $humidity_1[] = $row['humidity_1'];
            $air_quality_1[] = $row['air_quality_1'];
            $temperature_2[] = $row['temperature_2'];
            $humidity_2[] = $row['humidity_2'];
            $air_quality_2[] = $row['air_quality_2'];
            $time[] = $row['time'];

        }
        Database::disconnect();

        ?>
        <br>
        <canvas id="canvas_1"></canvas>
        <canvas id="canvas_2"></canvas>
        <canvas id="canvas_3"></canvas>
        <canvas id="canvas_4"></canvas>
        <canvas id="canvas_5"></canvas>
        <canvas id="canvas_6"></canvas>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // JavaScript code to create a bar chart using Chart.js
        var ctx_1 = document.getElementById('canvas_1');
        var chart = new Chart(ctx_1, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Temperature 1',
                    data: <?php echo json_encode($temperature_1); ?>,
                    backgroundColor: "red",
                    borderColor: "red",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var ctx_2 = document.getElementById('canvas_2');
        var chart = new Chart(ctx_2, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Humidity 1',
                    data: <?php echo json_encode($humidity_1); ?>,
                    backgroundColor: "blue",
                    borderColor: "blue",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var ctx_3 = document.getElementById('canvas_3');
        var chart = new Chart(ctx_3, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Air Quality 1',
                    data: <?php echo json_encode($air_quality_1); ?>,
                    backgroundColor: "green",
                    borderColor: "green",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var ctx_4 = document.getElementById('canvas_4');
        var chart = new Chart(ctx_4, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Temperature 2',
                    data: <?php echo json_encode($temperature_2); ?>,
                    backgroundColor: "red",
                    borderColor: "red",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var ctx_5 = document.getElementById('canvas_5');
        var chart = new Chart(ctx_5, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Humidity 2',
                    data: <?php echo json_encode($humidity_2); ?>,
                    backgroundColor: "blue",
                    borderColor: "blue",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var ctx_6 = document.getElementById('canvas_6');
        var chart = new Chart(ctx_6, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Air Quality 2',
                    data: <?php echo json_encode($air_quality_2); ?>,
                    backgroundColor: "green",
                    borderColor: "green",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!-- <script src="script.js"></script> -->
</body>

</html>
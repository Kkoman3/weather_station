<!DOCTYPE html>
<html>
<head>
    <title>Weather Station</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <style>
        html {font-family: 'Times New Roman', Times, serif; display: inline-block; text-align: center;}
        p {font-size: 1.2rem;}
        h4 {font-size: 0.8rem;}
        .content {padding: 5px; }
        .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
        .card.header {background-color: #9e0915; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
        .cards {max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
        .reading {font-size: 1.3rem;}
        .packet {color: #bebebe;}
        .temperatureColor {color: #fd7e14;}
        .humidityColor {color: #1b78e2;}
        .airqualityColor {color: #33CC33}
        .statusreadColor {color: #702963; font-size:12px;}
        .LEDColor {color: #183153;}
   </style>
</head>
<body>
    <?php include 'header.php'?>
    <br>
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
            $temperature_1[] =  $row['temperature_1'];
            $humidity_1[] = $row['humidity_1'];
            $air_quality_1[] = $row['air_quality_1'];
            $temperature_2[] =  $row['temperature_2'];
            $humidity_2[] = $row['humidity_2'];
            $air_quality_2[] = $row['air_quality_2'];
            $time[] = $row['time'];

        }
        Database::disconnect();
    ?>
    <br>
    <!-- __ DISPLAYS MONITORING AND CONTROLLING ____________________________________________________________________________________________ -->
    <div class="content">
      <div class="cards">
        
        <!-- == MONITORING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h2 style="font-size: 1.5rem;">MONITORING 1</h2>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h3 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE 1</h3>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp_1"></span> &deg;C</span></p>
          <h3 class="humidityColor"><i class="fas fa-tint"></i> HUMIDITY 1</h3>
          <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd_1"></span> &percnt;</span></p>
          <h3 class="airqualityColor"> AIR QUALITY 1</h3>
          <p class="airqualityColor"><span class="reading"><span id="ESP32_01_Air_Qua_1"></span> &percnt;</span></p>
          <!-- *********************************************************************** -->
          
          <!-- <p class="statusreadColor"><span>Status Read Sensor DHT11 : </span><span id="ESP32_01_Status_Read_DHT11"></span></p> -->
        </div>
        <!-- ======================================================================================================= -->
        
        <div class="card">
          <div class="card header">
            <h2 style="font-size: 1.5rem;">MONITORING 2</h2>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h3 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE 2</h3>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp_2"></span> &deg;C</span></p>
          <h3 class="humidityColor"><i class="fas fa-tint"></i> HUMIDITY 2</h3>
          <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd_2"></span> &percnt;</span></p>
          <h3 class="airqualityColor"> AIR QUALITY 2</h3>
          <p class="airqualityColor"><span class="reading"><span id="ESP32_01_Air_Qua_2"></span> &percnt;</span></p>
          <!-- *********************************************************************** -->
          
          <!-- <p class="statusreadColor"><span>Status Read Sensor DHT11 : </span><span id="ESP32_01_Status_Read_DHT11"></span></p> -->
        </div>
        <!-- == CONTROLLING ======================================================================================== -->
        <!-- <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">CONTROLLING</h3>
          </div> -->
          
          <!-- Buttons for controlling the LEDs on Slave 2. ************************** -->
          <!-- <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 1</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01')">
            <div class="sliderTS"></div>
          </label>
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02')">
            <div class="sliderTS"></div>
          </label> -->
          <!-- *********************************************************************** -->
        <!-- </div>   -->
        <!-- ======================================================================================================= -->
        
      </div>
    </div>
    <br>
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h2 style="font-size: 1.25rem;">LAST TIME RECEIVED DATA FROM ESP32 [ <span id="ESP32_01_LTRD"></span> ]</h2>
            <!-- <button onclick="window.open('history.php', '_blank');">Open Record Table</button> -->
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
      </div>
    </div>
    <br>

    <!-- ___________________________________________________________________________________________________________________________________ -->
    
    <script>
      //------------------------------------------------------------
      document.getElementById("ESP32_01_Temp_1").innerHTML = "NN"; 
      document.getElementById("ESP32_01_Humd_1").innerHTML = "NN";
      document.getElementById("ESP32_01_Air_Qua_1").innerHTML = "NN"; 

      document.getElementById("ESP32_01_Temp_2").innerHTML = "NN";
      document.getElementById("ESP32_01_Humd_2").innerHTML = "NN"; 
      document.getElementById("ESP32_01_Air_Qua_2").innerHTML = "NN";
      // document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
      document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
      //------------------------------------------------------------
      
      Get_Data("esp32_01");
      
      setInterval(myTimer, 5000);
      
      //------------------------------------------------------------
      function myTimer() {
        Get_Data("esp32_01");
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Get_Data(id) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // console.log(xmlhttp.onreadystatechange);
            console.log(this.responseText);
            const myObj = JSON.parse(this.responseText);
            console.log(myObj);
            if (myObj.id == "esp32_01") {
              document.getElementById("ESP32_01_Temp_1").innerHTML = myObj.temperature_1;
              document.getElementById("ESP32_01_Humd_1").innerHTML = myObj.humidity_1;
              document.getElementById("ESP32_01_Air_Qua_1").innerHTML = myObj.air_quality_1;
              document.getElementById("ESP32_01_Temp_2").innerHTML = myObj.temperature_2;
              document.getElementById("ESP32_01_Humd_2").innerHTML = myObj.humidity_2;
              document.getElementById("ESP32_01_Air_Qua_2").innerHTML = myObj.air_quality_2;
              document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
            }
          }
        };
        xmlhttp.open("POST","getdata.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // console.log("hi");
        xmlhttp.send("id="+id);
			}

      // function Get_Data(id) {
      //   var xmlhttp = new XMLHttpRequest();
      //   xmlhttp.onreadystatechange = function () {
      //       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      //           // Xử lý dữ liệu ở đây nếu yêu cầu thành công
      //           const myObj = JSON.parse(this.responseText);
      //           if (myObj.id == "esp32_01") {
      //           document.getElementById("ESP32_01_Temp_1").innerHTML = myObj.temperature;
      //           document.getElementById("ESP32_01_Humd_1").innerHTML = myObj.humidity;
      //           document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
      //           document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
      //           if (myObj.LED_01 == "ON") {
      //             document.getElementById("ESP32_01_TogLED_01").checked = true;
      //           } else if (myObj.LED_01 == "OFF") {
      //             document.getElementById("ESP32_01_TogLED_01").checked = false;
      //           }
      //           if (myObj.LED_02 == "ON") {
      //             document.getElementById("ESP32_01_TogLED_02").checked = true;
      //           } else if (myObj.LED_02 == "OFF") {
      //             document.getElementById("ESP32_01_TogLED_02").checked = false;
      //           }
      //         }
      //           console.log(xmlhttp.responseText);
      //       } else if (xmlhttp.readyState == 4 && xmlhttp.status != 200) {
      //           // Xử lý lỗi ở đây nếu yêu cầu không thành công
      //           console.error('Yêu cầu không thành công');
      //       }
      //   };
      //   xmlhttp.open("POST","getdata.php",true);
      //   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //   xmlhttp.send("id="+id);
      // // xmlhttp.open("GET", "https://example.com/api/data", true);
      // // xmlhttp.send();

      // }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      // function GetTogBtnLEDState(togbtnid) {
      //   if (togbtnid == "ESP32_01_TogLED_01") {
      //     var togbtnchecked = document.getElementById(togbtnid).checked;
      //     var togbtncheckedsend = "";
      //     if (togbtnchecked == true) togbtncheckedsend = "ON";
      //     if (togbtnchecked == false) togbtncheckedsend = "OFF";
      //     Update_LEDs("esp32_01","LED_01",togbtncheckedsend);
      //   }
      //   if (togbtnid == "ESP32_01_TogLED_02") {
      //     var togbtnchecked = document.getElementById(togbtnid).checked;
      //     var togbtncheckedsend = "";
      //     if (togbtnchecked == true) togbtncheckedsend = "ON";
      //     if (togbtnchecked == false) togbtncheckedsend = "OFF";
      //     Update_LEDs("esp32_01","LED_02",togbtncheckedsend);
      //   }
      // }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      // function Update_LEDs(id,lednum,ledstate) {
			// 	if (window.XMLHttpRequest) {
      //     // code for IE7+, Firefox, Chrome, Opera, Safari
      //     xmlhttp = new XMLHttpRequest();
      //   } else {
      //     // code for IE6, IE5
      //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      //   }
      //   xmlhttp.onreadystatechange = function() {
      //     if (this.readyState == 4 && this.status == 200) {
      //       //document.getElementById("demo").innerHTML = this.responseText;
      //     }
      //   }
      //   xmlhttp.open("POST","updateLEDs.php",true);
      //   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //   xmlhttp.send("id="+id+"&lednum="+lednum+"&ledstate="+ledstate);
			// }
      //------------------------------------------------------------
    </script>

    <div class="container">
        <canvas id="canvas"></canvas>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // JavaScript code to create a bar chart using Chart.js
        var ctx = document.getElementById('canvas');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($time); ?>,
                datasets: [{
                    label: 'Temperature 1',
                    data: <?php echo json_encode($temperature_1); ?>,
                    backgroundColor: "red",
                    borderColor: "red",
                    borderWidth: 1
                },
                {
                    label: 'Humidity 1',
                    data: <?php echo json_encode($humidity_1); ?>,
                    backgroundColor: "blue",
                    borderColor: "blue",
                    borderWidth: 1
                },
                {
                    label: 'Air Quality 1',
                    data: <?php echo json_encode($air_quality_1); ?>,
                    backgroundColor: "green",
                    borderColor: "green",
                    borderWidth: 1
                },
                {
                    label: 'Temperature 2',
                    data: <?php echo json_encode($temperature_2); ?>,
                    backgroundColor: "red",
                    borderColor: "red",
                    borderWidth: 1
                },
                {
                    label: 'Humidity 2',
                    data: <?php echo json_encode($humidity_2); ?>,
                    backgroundColor: "blue",
                    borderColor: "blue",
                    borderWidth: 1
                },
                {
                    label: 'Air Quality 2',
                    data: <?php echo json_encode($air_quality_2); ?>,
                    backgroundColor: "green",
                    borderColor: "green",
                    borderWidth: 1
                }
            ]
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

</body>
</html>

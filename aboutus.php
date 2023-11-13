<!DOCTYPE html>
<html>
<head>
    <title>Weather Station</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Liên kết đến tệp CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        .content {padding: 5px; }
        .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px; text-align: center;}
        .card.header {background-color: #9e0915; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
        .cards {max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
        .customColor {color: #9e0915;}
    </style>
</head>
<body>
    <?php include 'header.php'?>
    <br>
    <div class = "content">
        <div class = "cards">
        <div class="card">
          <div class="card header">
            <h2 style="font-size: 1.5rem;">WELCOME TO PROJECT </h2>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h3 class="customColor"> TRAN TRONG THANG</h3>
          <h3 class="customColor"> ID: DT030240</h3>
          <h3 class="customColor"> CLASS: DT3B</h3>
          <h3 class="customColor"><i class="phone-icon fas fa-phone"></i>  0369587988</h3>
          <h3 class="customColor"><i class="email-icon fas fa-envelope"></i>  thangkmaht3@gmail.com</h3>
          <!-- *********************************************************************** -->
          
          <!-- <p class="statusreadColor"><span>Status Read Sensor DHT11 : </span><span id="ESP32_01_Status_Read_DHT11"></span></p> -->
        </div>
        </div>
    </div>
</body>
</html>
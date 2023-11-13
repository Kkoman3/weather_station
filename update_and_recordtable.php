<?php
require 'database.php';

//-------------------------Condition to check that POST value is not empty
if (!empty($_POST)) {
    //---------------------keep track POST values
    $id = $_POST['id'];
    $temperature_1 = $_POST['temperature_1'];
    $humidity_1 = $_POST['humidity_1'];
    $air_quality_1 = $_POST['air_quality_1'];
    $temperature_2 = $_POST['temperature_2'];
    $humidity_2 = $_POST['humidity_2'];
    $air_quality_2 = $_POST['air_quality_2'];

    //--------------------Get the time and date
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $tm = date("H:i:s");
    $dt = date("Y-m-d");

    //-------------------Updating the data in the table
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE esp32_table_update SET temperature_1 = ?, humidity_1 = ?, air_quality_1 = ?, temperature_2 = ?, humidity_2 = ?, air_quality_2 = ?, time = ?, date = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($temperature_1, $humidity_1, $air_quality_1, $temperature_2, $humidity_2, $air_quality_2, $tm, $dt, $id));
    Database::disconnect();

    //--------------------Entering data into o table
    $id_key;
    $board = $_POST['id'];
    $found_empty = false;


    $pdo = Database::connect();

    //:::::::: Process to check if "id" is already in use.
    while ($found_empty == false) {
        $id_key = generate_string_id(10);
        // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
        // This table is used to store and record DHT11 sensor data updated by ESP32. 
        // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
        // This table is operated with the "INSERT" command, so this table will contain many rows.
        // Before saving and recording data in this table, the "id" will be checked first, to ensure that the "id" that has been created has not been used in the table.
        $sql = 'SELECT * FROM esp32_table_record WHERE id="' . $id_key . '"';
        $q = $pdo->prepare($sql);
        $q->execute();

        if (!$data = $q->fetch()) {
            $found_empty = true;
        }
    }
    //::::::::

    //:::::::: The process of entering data into a table.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO esp32_table_record (id,board,temperature_1,humidity_1,air_quality_1,temperature_2,humidity_2,air_quality_2,time,date) values(?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_key, $board, $temperature_1, $humidity_1, $air_quality_1, $temperature_2, $humidity_2, $air_quality_2, $tm, $dt));

    Database::disconnect();
}
//---------------------------------------- Function to create "id" based on numbers and characters.
function generate_string_id($strength = 16)
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}
?>
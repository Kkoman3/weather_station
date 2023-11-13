<?php
    include 'database.php';

    //-------------------Condition to check that POST value is not empty
    if(!empty($_POST)){
        //keep track post value
        $id = $_POST['id'];

        $myObj = (object)array();

        $pdo = Database::connect();
        $sql = 'SELECT * FROM esp32_table_update WHERE id="'.$id.'"';
        foreach ($pdo->query($sql) as $row){
            $date = date_create($row['date']);
            $dateFormat = date_format($date,"d-m-Y");

            $myObj->id = $row['id'];
            $myObj->temperature_1 = $row['temperature_1'];
            $myObj->humidity_1 = $row['humidity_1'];
            $myObj->air_quality_1 = $row['air_quality_1'];
            $myObj->temperature_2 = $row['temperature_2'];
            $myObj->humidity_2 = $row['humidity_2'];
            $myObj->air_quality_2 = $row['air_quality_2'];
            $myObj->ls_time = $row['time'];
            $myObj->ls_date = $dateFormat;
            
            $myJSON = json_encode($myObj);

            echo $myJSON;
        }
        Database::disconnect();
    }
?>
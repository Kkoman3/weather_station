<!DOCTYPE html>
<html>
<head>
    <title>Weather Station</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'header.php'?>
    <div class="container">
        <div class="title"><h2>Table Record</h2></div>
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
    </div>
    <br>
    <table class="styled-table" id="table_id">
        <thead>
            <tr>
                <th>NO</th>
                <th>ID</th>
                <th>BOARD</th>
                <th>TEMPERATURE 1</th>
                <th>HUMIDITY 1</th>
                <th>AIR QUALITY 1</th>
                <th>TEMPERATURE 2</th>
                <th>HUMIDITY 2</th>
                <th>AIR QUALITY 2</th>
                <th>TIME</th>
                <th>DATE (dd-mm-yyy)</th>
            </tr>
        </thead>
        <tbody id="tbody_table_record">
            <?php
                include 'database.php';
                $num = 0;
                $pdo = Database::connect();
                $sql = 'SELECT * FROM esp32_table_record ORDER BY date, time';          
                foreach ($pdo->query($sql) as $row) {
                    $date = date_create($row['date']);
                    $dateFormat = date_format($date,"d-m-Y");
                    $num++;
                    echo '<tr>';
                    echo '<td>'. $num . '</td>';
                    echo '<td class="bdr">'. $row['id'] . '</td>';
                    echo '<td class="bdr">'. $row['board'] . '</td>';
                    echo '<td class="bdr">'. $row['temperature_1'] . '</td>';
                    echo '<td class="bdr">'. $row['humidity_1'] . '</td>';
                    echo '<td class="bdr">'. $row['air_quality_1'] . '</td>';
                    echo '<td class="bdr">'. $row['temperature_2'] . '</td>';
                    echo '<td class="bdr">'. $row['humidity_2'] . '</td>';
                    echo '<td class="bdr">'. $row['air_quality_2'] . '</td>';
                    echo '<td class="bdr">'. $row['time'] . '</td>';
                    echo '<td>'. $dateFormat . '</td>';
                    echo '</tr>';
                }
                Database::disconnect();
            ?>
      </tbody>
    </table>

    <br>
    
    <div class="btn-group">
      <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
      <button class="button" id="btn_next" onclick="nextPage()">Next</button>
      <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
        <p style="position:relative; font-size: 14px;"> Table : <span id="page"></span></p>
      </div>
      <select name="number_of_rows" id="number_of_rows">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
    </div>

    <br>
    <script>
      //------------------------------------------------------------
      var current_page = 1;
      var records_per_page = 10;
      var l = document.getElementById("table_id").rows.length
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");
       
        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
          if (listing_table.rows[i]) {
            listing_table.rows[i].style.display = ""
          } else {
            continue;
          }
        }
          
        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l-1) + ") | Number of Rows : ";
        
        if (page == 0 && numPages() == 0) {
          btn_prev.disabled = true;
          btn_next.disabled = true;
          return;
        }

        if (page == 1) {
          btn_prev.disabled = true;
        } else {
          btn_prev.disabled = false;
        }

        if (page == numPages()) {
          btn_next.disabled = true;
        } else {
          btn_next.disabled = false;
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function numPages() {
        return Math.ceil((l - 1) / records_per_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      };
      //------------------------------------------------------------
    </script>
</body>
</html>

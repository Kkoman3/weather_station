<header>
    <h1>Weather Station</h1>
    <ul>
        <li><a href="index.php" <?php if ($_SERVER['REQUEST_URI'] == '/index.php') echo 'class="active"'; ?>>Home</a></li>
        <li><a href="chart.php" <?php if ($_SERVER['REQUEST_URI'] == '/chart.php') echo 'class="active"'; ?>>Chart</a></li>
        <li><a href="history.php" <?php if ($_SERVER['REQUEST_URI'] == '/history.php') echo 'class="active"'; ?>>History</a></li>
        <li><a href="aboutus.php" <?php if ($_SERVER['REQUEST_URI'] == '/aboutus.php') echo 'class="active"'; ?>>About Us</a></li>
    </ul>
</header>

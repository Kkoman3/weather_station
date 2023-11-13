<?php
class Database {
    private static $dbName = 'esp_weather_station';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'sa';
    private static $dbUserPassword = '123@123a';

    private static $cont = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        // One connection through the whole application
        if (null == self::$cont) {
            try {
                self::$cont = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}
?>
<?php
class Database
{
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "treinacon";
    private static $conn;

    public static function getConnection(): PDO
    {
        if (self::$conn === null) {
            self::$conn = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conn;
    }
}
?>
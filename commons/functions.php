<!-- commons/functions.php -->
<?php

function connection()
{
    try {
        $hostname = HOSTNAME;
        $username = USERNAME;
        $password = PASSWORD;
        $dbname = DBNAME;
        $port = PORT;

        $conn = new PDO("mysql:host=$hostname; dbname=$dbname; port=$port; charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Lỗi kết nối đến CSDL: " . $e->getMessage();
    }
}



?>
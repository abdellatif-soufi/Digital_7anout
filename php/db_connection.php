<?php
$servername = "db";
$username = "root";
$password = "rootpassword";
$dbname = "grocery";

$maxRetries = 5;
$retries = 0;

while ($retries < $maxRetries) {
    try {
        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        break; // تصل بنجاح
    } catch (PDOException $e) {
        $retries++;
        sleep(2); // انتظر 2 ثواني
        if ($retries >= $maxRetries) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

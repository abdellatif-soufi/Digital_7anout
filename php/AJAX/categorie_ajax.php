<?php
require '../db_connection.php';
$sql = "SELECT * FROM categories";
$req = $pdo->prepare($sql);
$req->execute();
$categories = $req->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($categories);

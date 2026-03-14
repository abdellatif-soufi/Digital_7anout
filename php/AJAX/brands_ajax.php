<?php 
require '../db_connection.php';

if(isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
    
    $sql = "SELECT * FROM brands WHERE category_id = :category_id";
    $req = $pdo->prepare($sql);
    $req->execute(['category_id' => $categoryId]);
    $brands = $req->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($brands);
} else {
    echo json_encode([]);
}
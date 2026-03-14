<?php 
require '../db_connection.php';

if(isset($_POST['brand_id'])) {
    $brandId = $_POST['brand_id'];
    
    $sql = "SELECT * FROM products WHERE brand_id = :brand_id";
    $req = $pdo->prepare($sql);
    $req->execute([':brand_id' => $brandId]);
    $products = $req->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($products);
} else {
    echo json_encode([]);
}
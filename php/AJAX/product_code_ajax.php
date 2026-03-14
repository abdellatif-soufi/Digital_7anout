<?php 
require '../db_connection.php';

if(isset($_POST['barcode'])) {
    $barcode_product = $_POST['barcode'];
    
    $sql = "SELECT * FROM products WHERE barcode = :barcode";
    $req = $pdo->prepare($sql);
    $req->execute(['barcode' => $barcode_product]);
    $product = $req->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($product);
} else {
    echo json_encode([]);
}
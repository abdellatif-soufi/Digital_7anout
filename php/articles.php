<?php 
session_start(); 
require_once('db_connection.php');

if(isset($_POST['add'])){
    if((isset($_POST['name']) &&
        (isset($_FILES['image']) && $_FILES['image']['error'] == 0) &&
        isset($_POST['selling-price']) &&
        isset($_POST['purchase-price']) &&
        isset($_POST['stock-quantity']) &&
        isset($_POST['barcode']) &&
        isset($_POST['product-brand']) 
    )
      ){
        $name = strip_tags($_POST['name']);
        $selling_price = strip_tags($_POST['selling-price']);
        $purchase_price = strip_tags($_POST['purchase-price']);
        $stock_quantity = strip_tags($_POST['stock-quantity']);
        $barcode = strip_tags($_POST['barcode']);
        $brand = strip_tags($_POST['product-brand']);

        $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        $image_name = str_replace(' ','_',$name).".".$ext;
        $image_path = "../imgs/products-img/".$image_name;

        if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
            $sql = "INSERT INTO products (name,image,selling_price,purchase_price,stock_quantity,barcode,brand_id) 
                    VALUES (:name,:image,:sellingPrice,:purchasePrice,:stockQuantity,:barcode,:brand)";
            $req = $pdo->prepare($sql);
            $req->bindValue(':name',$name,PDO::PARAM_STR);
            $req->bindValue(':image',$image_path,PDO::PARAM_STR);
            $req->bindValue(':sellingPrice',$selling_price,PDO::PARAM_INT);
            $req->bindValue(':purchasePrice',$purchase_price,PDO::PARAM_INT);
            $req->bindValue(':stockQuantity',$stock_quantity,PDO::PARAM_INT);
            $req->bindValue(':barcode',$barcode,PDO::PARAM_STR);
            $req->bindValue(':brand',$brand,PDO::PARAM_INT);
            $req->execute();
            echo "<script>alert('✅ la article ajoutée avec succès !');document.location='articles.php';</script>";
            exit();
        }else{
            echo "<script>alert('❌ Échec du téléchargement de l\'image.');document.location='articles.php';</script>";
            exit();
        }
    }else{
        echo "<script>alert('⚠️ Veuillez entrer un nom de la article et choisir une image.');document.location='articles.php';</script>";
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/articles.css">
    <link rel="stylesheet" href="../css/global.css">

</head>
<body>
    <header class="header">
        <div class="header-left">
            <span><i class="fas fa-user"></i> User : <?php echo strtoupper($_SESSION['username'] ?? 'ADMIN'); ?></span>
        </div>
        <div class="header-center">
            <span id="current-time"></span>
        </div>
        <div class="header-right">
            <button class="close-btn" onclick="location.href='menu.php'">✕</button>
        </div>
    </header>

    <div class="container">
        <!-- Page Title -->
        <div class="page-title">
            <i class="fas fa-box-open"></i>
            <h2>Gestion des Produits</h2>
        </div>

        <div class="content-wrapper">
            <!-- Form Section -->
            <div class="form-section">
                <div class="form-header">
                    <i class="fas fa-plus-circle"></i>
                    <span>Ajouter / Modifier Produit</span>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="product-id">
                    
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-cube"></i> Nom du Produit
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="product-name" 
                            placeholder="Ex: Lait Jawda" 
                            required
                        >
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="purchase-price">
                                <i class="fas fa-dollar-sign"></i> Prix d'Achat (DH)
                            </label>
                            <input 
                                type="number" 
                                name="purchase-price" 
                                id="purchase-price" 
                                placeholder="3.50" 
                                step="0.01"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="selling-price">
                                <i class="fas fa-tag"></i> Prix de Vente (DH)
                            </label>
                            <input 
                                type="number" 
                                name="selling-price" 
                                id="selling-price" 
                                placeholder="4.00" 
                                step="0.01"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock-quantity">
                            <i class="fas fa-warehouse"></i> Quantité en Stock
                        </label>
                        <input 
                            type="number" 
                            name="stock-quantity" 
                            id="stock-quantity" 
                            placeholder="100" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="barcode">
                            <i class="fas fa-barcode"></i> Code-Barres
                        </label>
                        <input 
                            type="text" 
                            name="barcode" 
                            id="barcode" 
                            placeholder="6260809000012" 
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="product-category">
                            <i class="fas fa-th-large"></i> Catégorie
                        </label>
                        <select name="category" id="product-category" required>
                            <option value="">Choisir une catégorie...</option>
                            <?php
                                $sql = "SELECT * FROM categories" ;
                                $stmt = $pdo->query($sql);
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach($categories as $category):?>
                                <option value="<?=$category['id']?>"><?=$category['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product-brand">
                            <i class="fas fa-bookmark"></i> Marque
                        </label>
                        <select name="product-brand" id="product-brand" required>
                            <option value="">Choisir une marque...</option>
                            <?php
                                $sql = "SELECT * FROM brands" ;
                                $stmt = $pdo->query($sql);
                                $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach($brands as $brand):?>
                                <option value="<?=$brand['id']?>"><?=$brand['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>


                    
                    <div class="form-group">
                        <label for="product-image">
                            <i class="fas fa-image"></i> Image de l'article
                        </label>
                        <input 
                        type="file" 
                        name="image" 
                        id="product-image"
                        >
                        <div class="image-preview" id="imagePreview">
                            <div class="placeholder">
                                <i class="fas fa-image"></i>
                                <p>Aperçu de l'image</p>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" id="addProduct" name="add" class="btn btn-add">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                        <button type="submit" id="updateProduct" name="update" class="btn btn-update" >
                            <i class="fas fa-edit"></i> Modifier
                        </button>
                    </div>
                </form>
            </div>

            


            <!-- Table Section -->
            <div class="table-section">
                <div class="table-header">
                    <div class="table-title">
                        <i class="fas fa-list"></i>
                        <span>Liste des Produits</span>
                    </div>
                    <div class="search-box">
                        <input 
                            type="text" 
                            id="search-input" 
                            placeholder="Rechercher un produit..."
                        >
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 15%;">Nom</th>
                                <th style="width: 13%;">Image</th>
                                <th style="width: 8%;">Prix Achat</th>
                                <th style="width: 8%;">Prix Vente</th>
                                <th style="width: 7%;">Stock</th>
                                <th style="width: 10%;">Code-Barres</th>
                                <th style="width: 8%;">Marque</th>
                                <th style="width: 10%;">Catégorie</th>
                                <th style="width: 14%;">Actions</th>
                            </tr>
                        </thead>

                            <?php
                            $sql2 = "SELECT 
                                        P.id,
                                        P.name,
                                        P.image,
                                        P.selling_price,
                                        P.purchase_price,
                                        P.stock_quantity,
                                        P.barcode,
                                        P.brand_id,
                                        B.category_id,
                                        B.image AS brand_image,
                                        B.name AS brand_name,
                                        C.name AS category_name
                                    FROM products P
                                    JOIN brands B ON B.id = P.brand_id
                                    JOIN categories C ON C.id = B.category_id
                                    ";
                                $stmt = $pdo->query($sql2);
                                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                        <tbody id="products-tbody">
                            <?php foreach($products as $product):?>
                                <tr class="product">
                                    <td><?=$product['id']?></td>
                                    <td><?=$product['name']?></td>
                                    <td>
                                        <img src="<?=$product['image']?>" alt="<?=$product['name']?>" style="width:140px;" class="product-image" >
                                    </td>
                                    <td class="price-cell"><?=$product['purchase_price']?></td>
                                    <td class="price-cell"><?=$product['selling_price']?></td>
                                    <td><span class="stock-badge stock-high"><?=$product['stock_quantity']?></span></td>
                                    <td><?=$product['barcode']?></td>
                                    <td>
                                        <img src="<?=$product['brand_image']?>" alt="<?=$product['brand_name']?>" style="width:140px;" class="brand-image" >                                    
                                    </td>
                                    <td><span class="badge-category"><?=$product['category_name']?></span></td>
                                    <td>
                                        <button class="action-btn btn-edit" 
                                                data-id="<?=$product['id']?>"
                                                data-name="<?=$product['name']?>"
                                                data-image="<?=$product['image']?>"
                                                data-purPrice="<?=$product['purchase_price']?>"
                                                data-sellPrice="<?=$product['selling_price']?>"
                                                data-stock="<?=$product['stock_quantity']?>"
                                                data-barcode="<?=$product['barcode']?>"
                                                data-brand="<?=$product['brand_id']?>"
                                                data-category="<?=$product['category_id']?>"
                                                >
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>
                                        <button class="action-btn btn-delete" >
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/articles.js"></script>
    <script src="../js/global-time.js"></script>
</body>
</html>
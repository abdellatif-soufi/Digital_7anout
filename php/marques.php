<?php 
session_start(); 
require_once('db_connection.php');
if(isset($_POST['add'])){
    if((isset($_POST['name']) && isset($_POST['brand-category']) && (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
    )
      ){
        $name = strip_tags($_POST['name']);
        $category = strip_tags($_POST['brand-category']);

        $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        $image_name = str_replace(' ','_',$name).".".$ext;
        $image_path = "../imgs/brands-img/".$image_name;

        if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
            $sql = "INSERT INTO brands (name,image,category_id) VALUES (:name,:image,:category)";

            $req = $pdo->prepare($sql);
            $req->bindValue(':name',$name,PDO::PARAM_STR);
            $req->bindValue(':image',$image_path,PDO::PARAM_STR);
            $req->bindValue(':category',$category,PDO::PARAM_INT);
            $req->execute();

            echo "<script>alert('✅ la marques ajoutée avec succès !');document.location='marques.php';</script>";
            exit();
        }else{
            echo "<script>alert('❌ Échec du téléchargement de l\'image.');document.location='marques.php';</script>";
            exit();
        }
    }else{
        echo "<script>alert('⚠️ Veuillez entrer un nom de la marques et choisir une image.');document.location='marques.php';</script>";
        exit();
    }
}

if(isset($_POST['update'])){
    if(isset($_POST['name']))
    {
        $id = (int)$_POST['id'];
        $name = strip_tags($_POST['name']);
        $brandCategory = (int)$_POST['brand-category'];
        
        $sql = "SELECT * FROM brands WHERE id=:id";
        $req = $pdo->prepare($sql);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();

        $brand = $req->fetch(PDO::FETCH_ASSOC);
        
        if($brand){
            $image_path = $brand['image'];

            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
                $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                $image_name = str_replace(' ','_',$name).".".$ext;
                $image_path = "imgs/brands-img/".$image_name;
                move_uploaded_file($_FILES['image']['tmp_name'],$image_path);
            }
            
            $sql2 = "UPDATE brands SET name=:name,image=:image,category_id=:category_id WHERE id=:id";
            $req2 = $pdo->prepare($sql2);
            $req2->bindValue(':id',$id,PDO::PARAM_INT);
            $req2->bindValue(':name',$name,PDO::PARAM_STR);
            $req2->bindValue(':image',$image_path,PDO::PARAM_STR);
            $req2->bindValue(':category_id',$brandCategory,PDO::PARAM_INT);
            $req2->execute();
            header('location:marques.php');
            exit();
        }
    }
}

if(isset($_POST['delete'])){
        $id = (int)$_POST['id'];
        $sql = 'DELETE FROM brands WHERE id=:id';
        $req = $pdo->prepare($sql);
        $req-> bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();
        header('Location:marques.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Marques</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/marques.css">

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
            <i class="fas fa-bookmark"></i>
            <h2>Gestion des Marques</h2>
        </div>

        <div class="content-wrapper">
            <!-- Form Section -->
            <div class="form-section">
                <div class="form-header">
                    <i class="fas fa-plus-circle"></i>
                    <span>Ajouter / Modifier Marque</span>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="brand-id">
                    
                    <div class="form-group">
                        <label for="brand-name">
                            <i class="fas fa-tag"></i> Nom de la Marque
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="brand-name" 
                            placeholder="Ex: Coca-Cola, Nestlé..." 
                            required
                        >
                    </div>
                    

                    <div class="form-group">
                        <label for="brand-category">
                            <i class="fas fa-list"></i> Catégorie Associée
                        </label>
                        <select name="brand-category" id="brand-category" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            <?php
                                $sql2 = "SELECT * FROM categories" ;
                                $stmt2 = $pdo->query($sql2);
                                $categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach($categories as $category):?>
                                <option value="<?=$category['id']?>"><?=$category['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand-image">
                            <i class="fas fa-image"></i> Image de la Marque
                        </label>
                        <input 
                            type="file" 
                            name="image" 
                            id="brand-image"
                        >
                        <div class="image-preview" id="imagePreview">
                            <div class="placeholder">
                                <i class="fas fa-image"></i>
                                <p>Aperçu de l'image</p>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" id="addBrand" name="add"  class="btn btn-add">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                        <button type="submit" 
                                id="updateBrand" 
                                name="update" 
                                class="btn btn-update" 
                                disabled
                                
                                >
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
                        <span>Liste des Marques</span>
                    </div>
                    <div class="search-box">
                        <input 
                            type="text" 
                            id="search-input" 
                            placeholder="Rechercher une marque..."
                        >
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 8%;">ID</th>
                                <th style="width: 25%;">Nom</th>
                                <th style="width: 15%;">Image</th>
                                <th style="width: 22%;">Catégorie</th>
                                <th style="width: 30%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="brands-tbody">
                            <?php
                                $sql3 = "SELECT 
                                            B.id,
                                            B.name,
                                            B.image,
                                            B.category_id,
                                            C.name AS category_name
                                        FROM brands B
                                        JOIN categories C ON C.id = B.category_id
                                        ";
                                $stmt3 = $pdo->query($sql3);
                                $brands = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach($brands as $brand):?>
                                <tr class="brand">
                                    <td><?=$brand['id']?></td>
                                    <td><?=$brand['name']?></td>
                                    <td>
                                        <img src="<?=$brand['image']?>" alt="<?=$brand['name']?>" class="brand-image" >
                                    </td>
                                    <td>
                                        <span class="category-badge" value="<?=$brand['category_name']?>"><?=$brand['category_name']?></span>
                                    </td>
                                    <td>
                                        <button class="action-btn btn-edit"
                                                data-id="<?=$brand['id']?>"
                                                data-name="<?=$brand['name']?>"
                                                data-image="<?=$brand['image']?>"
                                                data-category="<?=$brand['category_id']?>">
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?=$brand['id'];?>">
                                            <button name="delete" class="action-btn btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟');" >
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/marques.js"></script>
    <script src="../js/global-time.js"></script>
</body>
</html>
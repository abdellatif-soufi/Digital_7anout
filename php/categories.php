<?php 
session_start(); 
require_once('db_connection.php');

if(isset($_POST['add'])){
    if((isset($_POST['name']) && (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
    )
      ){
        $name = strip_tags($_POST['name']);
        $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        $image_name = str_replace(' ','_',$name).".".$ext;
        $image_path = "../imgs/categories-img/".$image_name;

        if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
            $sql = "INSERT INTO categories (name,image) VALUES (:name,:image)";
            $req = $pdo->prepare($sql);
            $req->bindValue(':name',$name,PDO::PARAM_STR);
            $req->bindValue(':image',$image_path,PDO::PARAM_STR);
            $req->execute();
            header('location:categories.php');
            exit();
        }else{
            header('location:categories.php');
            exit();
        }
    }else{
        header('location:categories.php');
        exit();
    }
}

if(isset($_POST['update'])){
    if(isset($_POST['name']))
    {
        $id = (int)$_POST['id'];
        $name = strip_tags($_POST['name']);
        
        $sql = "SELECT * FROM categories WHERE id=:id";
        $req = $pdo->prepare($sql);
        $req->bindValue(':id',$id,PDO::PARAM_INT);
        $req->execute();

        $category = $req->fetch(PDO::FETCH_ASSOC);
        
        if($category){
            $image_path = $category['image'];

            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
                $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                $image_name = str_replace(' ','_',$name).".".$ext;
                $image_path = "../imgs/categories-img/".$image_name;
                move_uploaded_file($_FILES['image']['tmp_name'],$image_path);
            }
            
            $sql2 = "UPDATE categories SET name=:name,image=:image WHERE id=:id";
            $req2 = $pdo->prepare($sql2);
            $req2->bindValue(':id',$id,PDO::PARAM_INT);
            $req2->bindValue(':name',$name,PDO::PARAM_STR);
            $req2->bindValue(':image',$image_path,PDO::PARAM_STR);
            $req2->execute();
            header('location:categories.php');
            exit();
        }
    }
}

if(isset($_POST['delete'])){
    $id = (int)$_POST['id'];
    $sql = 'DELETE FROM categories WHERE id=:id';
    $req = $pdo->prepare($sql);
    $req-> bindValue(':id',$id,PDO::PARAM_INT);
    $req->execute();
    header('Location:categories.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/categories.css">
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
            <i class="fas fa-th-large"></i>
            <h2>Gestion des Catégories</h2>
        </div>

        <div class="content-wrapper">
            <!-- Form Section -->
            <div class="form-section">
                <div class="form-header">
                    <i class="fas fa-plus-circle"></i>
                    <span>Ajouter / Modifier Catégorie</span>
                </div>

                <form method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="id" id="category-id">

                    <div class="form-group">
                        <label for="category-name">
                            <i class="fas fa-tag"></i> Nom de la Catégorie
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="category-name" 
                            placeholder="Entrez le nom de la catégorie..." 
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="category-image">
                            <i class="fas fa-image"></i> Image de la Marque
                        </label>
                        <input 
                            type="file" 
                            name="image" 
                            id="category-image"
                        >
                        <div class="image-preview" id="imagePreview">
                            <div class="placeholder">
                                <i class="fas fa-image"></i>
                                <p>Aperçu de l'image</p>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" name="add" id="addCategory" class="btn btn-add">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                        <button type="submit" name="update" id="updateCategory" class="btn btn-update" disabled>
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
                        <span>Liste des Catégories</span>
                    </div>
                    <div class="search-box">
                        <input 
                            type="text" 
                            id="search-input" 
                            placeholder="Rechercher une catégorie..."
                        >
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">ID</th>
                                <th style="width: 45%;">Nom Catégorie</th>
                                <th style="width: 15%;">Image</th>
                                <th style="width: 30%;">Actions</th>
                            </tr>
                        </thead>

                        <?php
                        $sql2 = "SELECT * FROM categories ORDER BY id ASC";
                        $stmt = $pdo->prepare($sql2);
                        $stmt->execute();
                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <tbody id="categories-tbody">                            
                            <?php foreach($categories as $category):?>
                                <tr class="category">
                                    <td><?=$category['id']?></td>
                                    <td><?=$category['name']?></td>
                                    <td>
                                        <img src="<?=$category['image']?>" alt="<?=$category['name']?>" style="width:140px;" class="category-image" >
                                    </td>
                                    <td>
                                        <button class="action-btn btn-edit" >
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?=$category['id'];?>">
                                            <button name="delete" class="action-btn btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟');" >
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                                
    <script src="../js/categories.js"></script>
    <script src="../js/global-time.js"></script>
</body> 
</html>
<?php
session_start();
include('db_connection.php');

// Get current user info (assuming username is stored in session)
$current_user = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
$current_time = date('H:i');
$current_date = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>
    
    <div class="main-container">
        <header>
            <div class="header-left">
                <h4><i class="fas fa-tachometer-alt me-2"></i>MAIN MENU</h4>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($current_user); ?>
                </div>
                <div class="time-info" id="current-time">
                    <i class="fas fa-clock me-1"></i><?php echo $current_time; ?> | <?php echo $current_date; ?>
                </div>
            </div>
        </header>
        
        <div class="content-area">
            <div class="menu-grid">
                <a href="categories.php" class="menu-item">
                    <div class="icon"><i class="fas fa-tags"></i></div>
                    <h5 class="title">Categories</h5>
                </a>
                
                <a href="marques.php" class="menu-item">
                    <div class="icon"><i class="fas fa-list-alt"></i></div>
                    <h5 class="title">brands</h5>
                </a>

                <a href="articles.php" class="menu-item">
                    <div class="icon"><i class="fas fa-box"></i></div>
                    <h5 class="title">Products</h5>
                </a>
                
                <a href="reglement.php" class="menu-item">
                    <div class="icon"><i class="fas fa-credit-card"></i></div>
                    <h5 class="title">Payments</h5>
                </a>
                
                <a href="stock.php" class="menu-item">
                    <div class="icon"><i class="fas fa-warehouse"></i></div>
                    <h5 class="title">Inventory</h5>
                </a>
                
                <a href="tickets.php" class="menu-item">
                    <div class="icon"><i class="fas fa-ticket-alt"></i></div>
                    <h5 class="title">Tickets</h5>
                </a>
                
                <a href="caisse.php" class="menu-item">
                    <div class="icon"><i class="fas fa-cash-register"></i></div>
                    <h5 class="title">Cash Register</h5>
                </a>
                
                <a href="etat.php" class="menu-item">
                    <div class="icon"><i class="fas fa-chart-bar"></i></div>
                    <h5 class="title">Reports</h5>
                </a>
                
                <a href="parametres.php" class="menu-item">
                    <div class="icon"><i class="fas fa-cog"></i></div>
                    <h5 class="title">Settings</h5>
                </a>
                
                <a href="charges.php" class="menu-item">
                    <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                    <h5 class="title">Expenses</h5>
                </a>
                
                <a href="logout.php" class="menu-item logout">
                    <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                    <h5 class="title">Logout</h5>
                </a>
            </div>
        </div>
    </div>
    
    <script src="js/frameWork/jquery-3.7.1.js"></script>
    <script src="js/frameWork/popper.min.js"></script>
    <script src="js/frameWork/bootstrap.js"></script>
    
    <script src="../js/menu.js"></script>
</body>
</html>
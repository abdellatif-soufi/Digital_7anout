<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de l'Inventaire</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/stock.css">

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
            <i class="fas fa-boxes"></i>
            <h2>Gestion de l'Inventaire</h2>
        </div>

        <!-- Stats Cards -->
        <div class="stats-section">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="stat-card-title">Total Produits</div>
                <div class="stat-card-value">1,247</div>
            </div>

            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="stat-card-title">Profit<br>Aujourd’hui</div>
                <div class="stat-card-value">150 DH</div>
            </div>

            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="stat-card-title">Profit Mensuel</div>
                <div class="stat-card-value">5455 DH</div>
            </div>

            <div class="stat-card stat-card-info">
                <div class="stat-card-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-card-title">Valeur Inventaire</div>
                <div class="stat-card-value">145,870 DH</div>
            </div>

            <div class="stat-card stat-card-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-card-title">Stock Bas</div>
                <div class="stat-card-value">23</div>
            </div>

            <div class="stat-card stat-card-danger">
                <div class="stat-card-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-card-title">Rupture Stock</div>
                <div class="stat-card-value">5</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-header">
                <i class="fas fa-filter"></i>
                <span>Filtrer l'Inventaire</span>
            </div>
            <div class="filter-row">
                <div class="filter-group">
                    <label><i class="fas fa-search"></i> Rechercher Produit</label>
                    <input type="text" id="search-input" placeholder="Nom, code-barres...">
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-th-large"></i> Catégorie</label>
                    <select id="filter-category">
                        <option value="">Toutes les catégories</option>
                        <option value="1">Lait</option>
                        <option value="2">Boissons</option>
                        <option value="3">Épicerie</option>
                        <option value="4">Produits Ménagers</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-layer-group"></i> État Stock</label>
                    <select id="filter-status">
                        <option value="">Tous les états</option>
                        <option value="high">En stock</option>
                        <option value="medium">Stock moyen</option>
                        <option value="low">Stock bas</option>
                        <option value="out">Rupture</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-bookmark"></i> Marque</label>
                    <select id="filter-brand">
                        <option value="">Toutes les marques</option>
                        <option value="1">Jawda</option>
                        <option value="2">Santra</option>
                        <option value="3">Coca-Cola</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button class="filter-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="table-header">
                <div class="table-title">
                    <i class="fas fa-list"></i>
                    <span>Liste des Produits en Stock</span>
                </div>
                <div class="table-actions">
                    <button class="table-action-btn btn-export">
                        <i class="fas fa-file-excel"></i> Exporter
                    </button>
                    <button class="table-action-btn btn-print">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 15%;">Produit</th>
                            <th style="width: 10%;">Code-Barres</th>
                            <th style="width: 10%;">Catégorie</th>
                            <th style="width: 10%;">Marque</th>
                            <th style="width: 8%;">Prix Achat</th>
                            <th style="width: 8%;">Prix Vente</th>
                            <th style="width: 5%;">Stock</th>
                            <th style="width: 10%;">État</th>
                            <th style="width: 10%;">Valeur</th>
                            <th style="width: 16%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventory-tbody">
                        <!-- Example Data -->
                        <tr>
                            <td>1</td>
                            <td>Lait Jawda 1L</td>
                            <td>6260809000012</td>
                            <td>Lait</td>
                            <td>Jawda</td>
                            <td class="price-cell">3.50 DH</td>
                            <td class="price-cell">4.00 DH</td>
                            <td><strong>150</strong></td>
                            <td><span class="stock-status status-high">En stock</span></td>
                            <td class="price-cell">525.00 DH</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-restock">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Coca-Cola 1L</td>
                            <td>5449000000996</td>
                            <td>Boissons</td>
                            <td>Coca-Cola</td>
                            <td class="price-cell">6.00 DH</td>
                            <td class="price-cell">7.50 DH</td>
                            <td><strong>45</strong></td>
                            <td><span class="stock-status status-medium">Stock moyen</span></td>
                            <td class="price-cell">270.00 DH</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-restock">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Lait Santra 1L</td>
                            <td>6282005400051</td>
                            <td>Lait</td>
                            <td>Santra</td>
                            <td class="price-cell">3.60 DH</td>
                            <td class="price-cell">4.00 DH</td>
                            <td><strong>12</strong></td>
                            <td><span class="stock-status status-low">Stock bas</span></td>
                            <td class="price-cell">43.20 DH</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-restock">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Eau Sidi Ali 1.5L</td>
                            <td>6111021102116</td>
                            <td>Boissons</td>
                            <td>Sidi Ali</td>
                            <td class="price-cell">2.50 DH</td>
                            <td class="price-cell">3.00 DH</td>
                            <td><strong>0</strong></td>
                            <td><span class="stock-status status-out">Rupture</span></td>
                            <td class="price-cell">0.00 DH</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-restock">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Fanta Orange 1L</td>
                            <td>5449000054227</td>
                            <td>Boissons</td>
                            <td>Coca-Cola</td>
                            <td class="price-cell">5.50 DH</td>
                            <td class="price-cell">7.00 DH</td>
                            <td><strong>85</strong></td>
                            <td><span class="stock-status status-high">En stock</span></td>
                            <td class="price-cell">467.50 DH</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-restock">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>


            <div class="pagination-section">
                <div class="pagination-info">
                    <i class="fas fa-info-circle"></i> Affichage de 1 à 8 sur 328 paiements
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">5</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">41</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="../js/global-time.js"></script>
</body>

</html>
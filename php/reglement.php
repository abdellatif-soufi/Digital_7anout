<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Paiements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/reglement.css">

    <style>


    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <span><i class="fas fa-user"></i> User : ADMIN</span>
        </div>
        <div class="header-center">
            <span id="current-time">Lundi, 27 Octobre 2025 - 14:30:25</span>
        </div>
        <div class="header-right">
            <button class="close-btn" onclick="location.href='menu.php'">✕</button>
        </div>
    </header>

    <!-- Page Container -->
    <div class="page-container">
        <!-- Page Title -->
        <div class="page-title">
            <h2><i class="fas fa-money-bill-wave"></i> Gestion des Paiements</h2>
        </div>

        <!-- Stats Cards -->
        <div class="stats-section">
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-card-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="stat-card-title">Total Encaissé</div>
                        <div class="stat-card-value">45,870 MAD</div>
                        <div class="stat-card-subtitle">Ce mois-ci</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-info">
                        <div class="stat-card-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="stat-card-title">Transactions</div>
                        <div class="stat-card-value">328</div>
                        <div class="stat-card-subtitle">Total paiements</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-card-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stat-card-title">Aujourd'hui</div>
                        <div class="stat-card-value">3,250 MAD</div>
                        <div class="stat-card-subtitle">15 transactions</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-danger">
                        <div class="stat-card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-card-title">Moyenne</div>
                        <div class="stat-card-value">140 MAD</div>
                        <div class="stat-card-subtitle">Par transaction</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <h3><i class="fas fa-plus-circle"></i> Enregistrer un Nouveau Paiement</h3>
            <form>
                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Nom du client
                        </label>
                        <select name="" id="" class="form-select">
                            <option value="">Sélectionner...</option>
                            <option value="">Ali Ben Salah</option>
                            <option value="">Fatima Zahra El Amri</option>
                            <option value="">Mohamed Chakir</option>
                            <option value="">Khadija Benjelloun</option>
                            <option value="">Omar Tazi</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-money-bill"></i> Montant payé
                        </label>
                        <input type="number" class="form-control" placeholder="Ex: 250.00" step="0.01">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-credit-card"></i> Méthode
                        </label>
                        <select class="form-select">
                            <option value="">Sélectionner...</option>
                            <option value="cash">Espèces</option>
                            <option value="card">Carte bancaire</option>
                            <option value="transfer">Virement</option>
                            <option value="check">Chèque</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i> Date du paiement
                        </label>
                        <input type="date" class="form-control" value="2025-10-28">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="table-header">
                <h3><i class="fas fa-history"></i> Historique des Paiements</h3>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Référence</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Méthode</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><strong>PAY-2025-001</strong></td>
                            <td>Ali Ben Salah</td>
                            <td><strong class="text-success">250.00 MAD</strong></td>
                            <td><span class="payment-badge payment-cash">Espèces</span></td>
                            <td>28/10/2025</td>
                            <td>14:23</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><strong>PAY-2025-002</strong></td>
                            <td>Fatima Zahra El Amri</td>
                            <td><strong class="text-success">120.00 MAD</strong></td>
                            <td><span class="payment-badge payment-card">Carte bancaire</span></td>
                            <td>27/10/2025</td>
                            <td>16:45</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><strong>PAY-2025-003</strong></td>
                            <td>Mohamed Chakir</td>
                            <td><strong class="text-success">450.00 MAD</strong></td>
                            <td><span class="payment-badge payment-transfer">Virement</span></td>
                            <td>27/10/2025</td>
                            <td>10:15</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><strong>PAY-2025-004</strong></td>
                            <td>Khadija Benjelloun</td>
                            <td><strong class="text-success">95.00 MAD</strong></td>
                            <td><span class="payment-badge payment-cash">Espèces</span></td>
                            <td>26/10/2025</td>
                            <td>18:30</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><strong>PAY-2025-005</strong></td>
                            <td>Omar Tazi</td>
                            <td><strong class="text-success">680.00 MAD</strong></td>
                            <td><span class="payment-badge payment-card">Carte bancaire</span></td>
                            <td>26/10/2025</td>
                            <td>11:20</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><strong>PAY-2025-006</strong></td>
                            <td>Salma Idrissi</td>
                            <td><strong class="text-success">175.00 MAD</strong></td>
                            <td><span class="payment-badge payment-cash">Espèces</span></td>
                            <td>25/10/2025</td>
                            <td>15:50</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><strong>PAY-2025-007</strong></td>
                            <td>Hassan Benali</td>
                            <td><strong class="text-success">320.00 MAD</strong></td>
                            <td><span class="payment-badge payment-transfer">Virement</span></td>
                            <td>25/10/2025</td>
                            <td>09:35</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><strong>PAY-2025-008</strong></td>
                            <td>Nadia Senhaji</td>
                            <td><strong class="text-success">540.00 MAD</strong></td>
                            <td><span class="payment-badge payment-card">Carte bancaire</span></td>
                            <td>24/10/2025</td>
                            <td>17:10</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-view-table">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-print-table">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-delete-table">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
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
<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rapports et Statistiques</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/etat.css">
</head>

<body>
  <!-- Header -->
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
      <h2>
        <i class="fas fa-chart-line"></i>
        Rapports et Statistiques
      </h2>
    </div>

    <!-- Stats Cards -->
    <div class="stats-section">
      <div class="row g-3">
        <div class="col-md-3">
          <div class="stat-card stat-card-primary">
            <div class="stat-card-icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-card-title">Chiffre d'Affaires</div>
            <div class="stat-card-value">87,450 DH</div>
            <div class="stat-card-subtitle">Ce mois-ci</div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="stat-card stat-card-info">
            <div class="stat-card-icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-card-title">Total Ventes</div>
            <div class="stat-card-value">1,247</div>
            <div class="stat-card-subtitle">Transactions</div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="stat-card stat-card-warning">
            <div class="stat-card-icon">
              <i class="fas fa-chart-pie"></i>
            </div>
            <div class="stat-card-title">Marge Bénéficiaire</div>
            <div class="stat-card-value">23,890 DH</div>
            <div class="stat-card-subtitle">Bénéfice net</div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="stat-card stat-card-danger">
            <div class="stat-card-icon">
              <i class="fas fa-users"></i>
            </div>
            <div class="stat-card-title">Clients</div>
            <div class="stat-card-value">856</div>
            <div class="stat-card-subtitle">Clients actifs</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
      <div class="filter-header">
        <i class="fas fa-filter"></i>
        <span>Générer un Rapport</span>
      </div>
      <form>
        <div class="row g-3 align-items-end">
          <div class="col-md-3">
            <label class="form-label">
              <i class="fas fa-calendar-alt"></i> Date de début
            </label>
            <input type="date" class="form-control" value="2025-10-01">
          </div>
          <div class="col-md-3">
            <label class="form-label">
              <i class="fas fa-calendar-check"></i> Date de fin
            </label>
            <input type="date" class="form-control" value="2025-10-30">
          </div>
          <div class="col-md-3">
            <label class="form-label">
              <i class="fas fa-list"></i> Type de rapport
            </label>
            <select class="form-select">
              <option value="sales">Rapport des ventes</option>
              <option value="products">Produits vendus</option>
              <option value="payments">Méthodes de paiement</option>
              <option value="inventory">État des stocks</option>
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-generate w-100">
              <i class="fas fa-file-alt"></i> Générer Rapport
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
      <div class="row g-3">
        <div class="col-md-8">
          <div class="chart-card">
            <h5>
              <i class="fas fa-chart-bar text-primary"></i>
              Évolution des Ventes Mensuelles
            </h5>
            <div class="chart-placeholder">
              <div class="text-center">
                <i class="fas fa-chart-bar d-block"></i>
                Graphique des ventes par mois
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="chart-card">
            <h5>
              <i class="fas fa-chart-pie text-warning"></i>
              Ventes par Catégorie
            </h5>
            <div class="chart-placeholder">
              <div class="text-center">
                <i class="fas fa-chart-pie d-block"></i>
                Répartition par catégorie
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Products Table -->
    <div class="table-card">
      <div class="table-header">
        <div class="table-title">
          <i class="fas fa-trophy"></i>
          <span>Top 10 des Produits les Plus Vendus</span>
        </div>
        <div class="table-actions">
          <button class="btn-export">
            <i class="fas fa-file-excel"></i> Exporter
          </button>
          <button class="btn-print">
            <i class="fas fa-print"></i> Imprimer
          </button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Rang</th>
              <th>Produit</th>
              <th>Catégorie</th>
              <th>Quantité Vendue</th>
              <th>Chiffre d'Affaires</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>#1</strong></td>
              <td>Lait Jawda 1L</td>
              <td>Lait</td>
              <td><strong>450</strong></td>
              <td class="amount-cell">1,800 DH</td>
              <td><span class="badge-custom badge-success">En stock</span></td>
            </tr>
            <tr>
              <td><strong>#2</strong></td>
              <td>Coca-Cola 1L</td>
              <td>Boissons</td>
              <td><strong>385</strong></td>
              <td class="amount-cell">2,887.50 DH</td>
              <td><span class="badge-custom badge-success">En stock</span></td>
            </tr>
            <tr>
              <td><strong>#3</strong></td>
              <td>Pain Complet</td>
              <td>Épicerie</td>
              <td><strong>320</strong></td>
              <td class="amount-cell">1,600 DH</td>
              <td><span class="badge-custom badge-warning">Stock bas</span></td>
            </tr>
            <tr>
              <td><strong>#4</strong></td>
              <td>Eau Sidi Ali 1.5L</td>
              <td>Boissons</td>
              <td><strong>298</strong></td>
              <td class="amount-cell">894 DH</td>
              <td><span class="badge-custom badge-danger">Rupture</span></td>
            </tr>
            <tr>
              <td><strong>#5</strong></td>
              <td>Yaourt Danone</td>
              <td>Produits Laitiers</td>
              <td><strong>275</strong></td>
              <td class="amount-cell">1,375 DH</td>
              <td><span class="badge-custom badge-success">En stock</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sales by Payment Method -->
    <div class="table-card">
      <div class="table-header">
        <div class="table-title">
          <i class="fas fa-credit-card"></i>
          <span>Ventes par Méthode de Paiement</span>
        </div>
        <div class="table-actions">
          <button class="btn-export">
            <i class="fas fa-file-excel"></i> Exporter
          </button>
          <button class="btn-print">
            <i class="fas fa-print"></i> Imprimer
          </button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Méthode</th>
              <th>Nombre de Transactions</th>
              <th>Montant Total</th>
              <th>Pourcentage</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><i class="fas fa-money-bill-wave text-success"></i> <strong>Espèces</strong></td>
              <td>856</td>
              <td class="amount-cell">52,340 DH</td>
              <td><strong>59.8%</strong></td>
            </tr>
            <tr>
              <td><i class="fas fa-credit-card text-primary"></i> <strong>Carte Bancaire</strong></td>
              <td>325</td>
              <td class="amount-cell">28,670 DH</td>
              <td><strong>32.8%</strong></td>
            </tr>
            <tr>
              <td><i class="fas fa-exchange-alt text-warning"></i> <strong>Virement</strong></td>
              <td>66</td>
              <td class="amount-cell">6,440 DH</td>
              <td><strong>7.4%</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script src="../js/etat.js"></script>
  <script src="../js/global-time.js"></script>
</body>
</html>
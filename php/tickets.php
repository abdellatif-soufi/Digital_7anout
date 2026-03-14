<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tickets / Factures</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/tickets.css">
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

  <div class="container mt-5">
    <h2 class="page-title">
      <i class="fas fa-receipt"></i>
      Gestion des Tickets
    </h2>

    <!-- Barre de recherche -->
    <div class="card p-3 mb-4 search-bar">
      <form class="row g-3 align-items-center">
        <div class="col-md-4">
          <label class="form-label mb-1">
            <i class="fas fa-ticket-alt"></i> Numéro du ticket
          </label>
          <input type="text" class="form-control" placeholder="Ex: TCK-1024">
        </div>
        <div class="col-md-4">
          <label class="form-label mb-1">
            <i class="fas fa-calendar-alt"></i> Date
          </label>
          <input type="date" class="form-control">
        </div>
        <div class="col-md-4 text-end mt-4">
          <button type="submit" class="btn btn-custom px-4">
            <i class="fas fa-search"></i> Rechercher
          </button>
        </div>
      </form>
    </div>

    <!-- Liste des tickets -->
    <div class="card p-4">
      <h5>
        <i class="fas fa-history"></i>
        Historique des Tickets
      </h5>
      <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Numéro Ticket</th>
              <th>Date</th>
              <th>Montant Total</th>
              <th>Méthode de Paiement</th>
              <th>Client</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><strong>TCK-1001</strong></td>
              <td>2025-10-25 14:30</td>
              <td class="amount-cell">120.00 MAD</td>
              <td><span class="payment-badge payment-especes">Espèces</span></td>
              <td>Client libre</td>
              <td>
                <button class="btn btn-sm btn-success">
                  <i class="fas fa-eye"></i> Voir
                </button>
                <button class="btn btn-sm btn-primary">
                  <i class="fas fa-print"></i> Imprimer
                </button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td><strong>TCK-1002</strong></td>
              <td>2025-10-26 10:15</td>
              <td class="amount-cell">75.50 MAD</td>
              <td><span class="payment-badge payment-carte">Carte</span></td>
              <td>Ahmed</td>
              <td>
                <button class="btn btn-sm btn-success">
                  <i class="fas fa-eye"></i> Voir
                </button>
                <button class="btn btn-sm btn-primary">
                  <i class="fas fa-print"></i> Imprimer
                </button>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td><strong>TCK-1003</strong></td>
              <td>2025-10-27 17:00</td>
              <td class="amount-cell">45.00 MAD</td>
              <td><span class="payment-badge payment-especes">Espèces</span></td>
              <td>Fatima</td>
              <td>
                <button class="btn btn-sm btn-success">
                  <i class="fas fa-eye"></i> Voir
                </button>
                <button class="btn btn-sm btn-primary">
                  <i class="fas fa-print"></i> Imprimer
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="../js/global-time.js"></script>
</body>
</html>
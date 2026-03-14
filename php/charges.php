<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Dépenses</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <style>
    :root {
      --primary-color: #28a745;
      --secondary-color: #20c997;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --info-color: #007bff;
      --dark-color: #343a40;
      --light-color: #f8f9fa;
      --white: #ffffff;
      --shadow: 0 2px 8px rgba(0,0,0,0.08);
      --shadow-hover: 0 4px 15px rgba(0,0,0,0.12);
      --border-radius: 6px;
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      color: #333;
      min-height: 100vh;
      padding-top: 40px;
    }

    /* Header Styles */
    .header {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      padding: 6px 15px;
      box-shadow: var(--shadow);
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 40px;
      color: white;
      font-weight: 600;
      font-size: 0.85rem;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .header-center {
      font-size: 0.9rem;
      font-weight: bold;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .close-btn {
      background: rgba(220, 53, 69, 0.9);
      border: none;
      width: 28px;
      height: 28px;
      border-radius: 4px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: var(--transition);
      font-size: 0.8rem;
    }

    .close-btn:hover {
      background: var(--danger-color);
      transform: scale(1.05);
    }

    .container {
      max-width: 1400px;
      margin-top: 20px;
    }

    h2 {
      color: var(--dark-color);
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
      position: relative;
      display: inline-block;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      border-radius: 2px;
    }

    .card {
      border-radius: 12px;
      box-shadow: var(--shadow);
      border: none;
      overflow: hidden;
      transition: var(--transition);
      background: var(--white);
    }

    .card:hover {
      box-shadow: var(--shadow-hover);
      transform: translateY(-2px);
    }

    .card-header {
      background: linear-gradient(135deg, var(--dark-color) 0%, #495057 100%);
      color: white;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 12px 20px;
      border: none;
    }

    .form-label {
      font-weight: 600;
      color: var(--dark-color);
      font-size: 0.85rem;
      margin-bottom: 6px;
    }

    .form-control, .form-select {
      border-radius: 8px;
      border: 2px solid #e9ecef;
      padding: 8px 12px;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--primary-color);
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .btn-add {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      color: white;
      font-weight: 600;
      border: none;
      padding: 10px 24px;
      border-radius: 8px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-add:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-hover);
      color: white;
    }

    .table {
      margin-bottom: 0;
      font-size: 0.85rem;
    }

    .table thead {
      background: linear-gradient(135deg, var(--dark-color) 0%, #495057 100%);
      color: white;
    }

    .table thead th {
      padding: 12px 10px;
      font-weight: 600;
      font-size: 0.85rem;
      text-align: center;
      border: none;
    }

    .table tbody td {
      padding: 12px 10px;
      vertical-align: middle;
      border-bottom: 1px solid #f1f3f4;
    }

    .table tbody tr {
      transition: var(--transition);
    }

    .table tbody tr:hover {
      background-color: rgba(198, 225, 255, 0.3);
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 0.75rem;
      border-radius: 6px;
      font-weight: 600;
      transition: var(--transition);
      border: none;
    }

    .btn-warning {
      background: var(--warning-color);
      color: #212529;
    }

    .btn-warning:hover {
      background: #e0a800;
      transform: translateY(-1px);
    }

    .btn-danger {
      background: var(--danger-color);
      color: white;
    }

    .btn-danger:hover {
      background: #c82333;
      transform: translateY(-1px);
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      animation: fadeIn 0.5s ease-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 0 15px;
      }

      h2 {
        font-size: 1.4rem;
      }

      .table {
        font-size: 0.75rem;
      }

      .btn-sm {
        padding: 4px 8px;
        font-size: 0.7rem;
      }
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="header-left">
      <span><i class="fas fa-user"></i> User : <?php echo strtoupper($_SESSION['username'])  ?></span>
    </div>
    <div class="header-center">
      <span id="current-time"></span>
    </div>
    <div class="header-right">
      <button class="close-btn" onclick="location.href='menu.php'">✕</button>
    </div>
  </header>

  <div class="container my-5">
    <h2 class="text-center mb-4"><i class="fas fa-chart-line"></i> Gestion des Dépenses</h2>

    <!-- Formulaire d'ajout d'une dépense -->
    <div class="card mb-4">
      <div class="card-header"><i class="fas fa-plus-circle"></i> Ajouter une Dépense</div>
      <div class="card-body">
        <form>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label"><i class="fas fa-tag"></i> Type de dépense</label>
              <select class="form-select" required>
                <option value="">Choisir...</option>
                <option value="electricité">Électricité</option>
                <option value="eau">Eau</option>
                <option value="transport">Transport</option>
                <option value="entretien">Entretien</option>
                <option value="autre">Autre</option>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label"><i class="fas fa-money-bill-wave"></i> Montant (DH)</label>
              <input type="number" class="form-control" placeholder="Ex: 150.00" required>
            </div>

            <div class="col-md-4">
              <label class="form-label"><i class="fas fa-calendar-alt"></i> Date</label>
              <input type="date" class="form-control" required>
            </div>

            <div class="col-12">
              <label class="form-label"><i class="fas fa-file-alt"></i> Description (facultatif)</label>
              <textarea class="form-control" rows="2" placeholder="Ex: Achat de fournitures de nettoyage..."></textarea>
            </div>

            <div class="col-12 text-end">
              <button type="submit" class="btn-add">
                <i class="fas fa-check-circle"></i> Ajouter la dépense
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tableau des dépenses -->
    <div class="card">
      <div class="card-header"><i class="fas fa-list"></i> Liste des Dépenses</div>
      <div class="card-body">
        <table class="table table-hover align-middle text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Montant (DH)</th>
              <th>Date</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Électricité</td>
              <td>250.00</td>
              <td>2025-10-20</td>
              <td>Facture mensuelle</td>
              <td>
                <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Modifier</button>
                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Transport</td>
              <td>60.00</td>
              <td>2025-10-21</td>
              <td>Livraison de produits</td>
              <td>
                <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Modifier</button>
                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script>
    // Horloge en temps réel
    setInterval(() => {
      let current_time = document.getElementById('current-time');
      let days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
      let d = new Date();
      current_time.textContent = `${days[d.getDay()]} ${d.toLocaleDateString('fr-FR')} ${d.toLocaleTimeString('fr-FR')}`;
    }, 100);
  </script>

</body>
</html>
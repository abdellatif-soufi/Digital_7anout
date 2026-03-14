<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Paramètres - Système de gestion d'épicerie</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/parametres.css">
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

  <div class="container my-4">
    <h2 class="mb-3"><i class="fas fa-sliders-h"></i> Paramètres du Système</h2>

    <!-- Store Info -->
    <div class="card">
      <div class="card-header-custom">
        <div class="section-title">
          <i class="fas fa-store"></i> Informations du magasin
        </div>
        <div class="note">Ces informations apparaîtront sur les factures.</div>
      </div>
      <div class="card-body-custom">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-building"></i> Nom du magasin</label>
              <input class="form-control" type="text" value="Épicerie Al Baraka">
            </div>
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
              <input class="form-control" type="text" value="+212661803100">
            </div>
            <div class="col-md-12">
              <label class="form-label"><i class="fas fa-map-marker-alt"></i> Adresse</label>
              <textarea class="form-control" rows="2">Quartier Mohammadi, Casablanca</textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-envelope"></i> E-mail</label>
              <input class="form-control" type="email" value="contact@epicerie.ma">
            </div>
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-image"></i> Logo (aperçu)</label>
              <div class="d-flex gap-2 align-items-center">
                <img src="placeholder-logo.png" alt="logo" class="logo-preview rounded">
                <input class="form-control" type="file" accept="image/*">
              </div>
            </div>
            <div class="col-12 text-end">
              <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer les informations</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Billing & Receipt -->
    <div class="card">
      <div class="card-header-custom">
        <div class="section-title">
          <i class="fas fa-file-invoice"></i> Facturation & Impression
        </div>
        <div class="note">Configurer l'en-tête et le pied des factures, la génération du ticket.</div>
      </div>
      <div class="card-body-custom">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-heading"></i> En-tête facture</label>
              <input class="form-control" type="text" value="EPICERIE AL BARAKA - Facture">
            </div>
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-shoe-prints"></i> Pied de page</label>
              <input class="form-control" type="text" value="Merci pour votre visite !">
            </div>
            <div class="col-md-6">
              <label class="form-label"><i class="fas fa-print"></i> Impression automatique après vente</label>
              <select class="form-select">
                <option>Oui</option>
                <option selected>Non</option>
              </select>
            </div>
            <div class="col-12 text-end">
              <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer facturation</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Currency & Tax -->
    <div class="card">
      <div class="card-header-custom">
        <div class="section-title">
          <i class="fas fa-money-bill-wave"></i> Monnaie & Taxes
        </div>
        <div class="note">Configurer la monnaie par défaut et le taux de TVA.</div>
      </div>
      <div class="card-body-custom">
        <form class="row g-3">
          <div class="col-md-4">
            <label class="form-label"><i class="fas fa-coins"></i> Monnaie</label>
            <input class="form-control" type="text" value="MAD">
          </div>
          <div class="col-md-4">
            <label class="form-label"><i class="fas fa-dollar-sign"></i> Symbole</label>
            <input class="form-control" type="text" value="DH">
          </div>
          <div class="col-md-4">
            <label class="form-label"><i class="fas fa-percentage"></i> Taux TVA (%)</label>
            <input class="form-control" type="number" min="0" max="100" value="20">
          </div>
          <div class="col-12 text-end">
            <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Payment Methods -->
    <div class="card">
      <div class="card-header-custom">
        <div class="section-title">
          <i class="fas fa-credit-card"></i> Méthodes de paiement
        </div>
        <div class="note">Activer / Désactiver les modes acceptés à la caisse.</div>
      </div>
      <div class="card-body-custom">
        <form class="row g-3">
          <div class="col-md-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="cash" checked>
              <label class="form-check-label" for="cash">
                <i class="fas fa-money-bill-wave"></i> Espèces
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="card" checked>
              <label class="form-check-label" for="card">
                <i class="fas fa-credit-card"></i> Carte
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="transfer">
              <label class="form-check-label" for="transfer">
                <i class="fas fa-exchange-alt"></i> Virement
              </label>
            </div>
          </div>
          <div class="col-12 text-end">
            <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer méthodes</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Users & Roles -->
    <div class="card">
      <div class="card-header-custom">
        <div class="section-title">
          <i class="fas fa-users"></i> Utilisateurs & Rôles
        </div>
        <div class="note">Gestion des comptes et permissions.</div>
      </div>
      <div class="card-body-custom">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom</th>
              <th>Rôle</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>mohamed</td>
              <td><span class="badge bg-success">owner</span></td>
              <td>
                <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i> Modifier</button>
                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Backup & Restore -->
    <div class="card">
      <div class="card-header-custom">
        <div class="section-title">
          <i class="fas fa-database"></i> Sauvegarde & Restauration
        </div>
        <div class="note">Exporter/Importer la base de données (SQL).</div>
      </div>
      <div class="card-body-custom">
        <div class="d-flex gap-2 flex-wrap">
          <button class="btn btn-outline-primary"><i class="fas fa-download"></i> Télécharger sauvegarde</button>
          <button class="btn btn-outline-danger"><i class="fas fa-upload"></i> Restaurer depuis fichier</button>
        </div>
      </div>
    </div>

  </div>

  <script src="../js/global-time.js"></script>

</body>
</html>
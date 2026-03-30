<?php
session_start();
require_once('db_connection.php');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Point de Vente - Caisse</title>
    <script src="../js/frameWork/jquery-3.7.1.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/caisse.css">
    <link rel="stylesheet" href="../css/global.css">
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

    <div class="main-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <!-- Ticket Header -->
            <div class="ticket-header">
                <h3><i class="fas fa-receipt"></i> Informations Facture</h3>
                <div class="form-group">
                    <label>Code :</label>
                    <input type="text" name="product_code" placeholder="Entrez le code...">
                </div>
                <div class="form-group">
                    <label>N° Facture :</label>
                    <div class="ticket-number">RRF-22-3056</div>
                </div>
            </div>

            <!-- Invoice Section -->
            <div class="invoice-section">
                <div class="invoice-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Qt.</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="factureTbody">

                        </tbody>
                    </table>
                </div>

                <!-- Total Section -->
                <div class="total-section">
                    <span class="total-label">
                        <i class="fas fa-calculator"></i> Total Facture :
                    </span>
                    <span class="total-amount">0.00 DH</span>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="action-btn btn-add" id="addBtn">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                    <button class="action-btn btn-edit" id="editBtn">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="action-btn btn-delete" id="deleteBtn">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                    <button class="action-btn btn-return">
                        <i class="fas fa-undo"></i> Retour
                    </button>
                    <button class="action-btn btn-clear" id="viderBtn">
                        <i class="fas fa-broom"></i> Vider
                    </button>
                    <button class="action-btn btn-cash">
                        <i class="fas fa-cash-register"></i> Caisse
                    </button>
                    <button class="action-btn btn-complete">
                        <i class="fas fa-check-circle"></i> Finaliser Vente
                    </button>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <!-- Header de navigation -->
            <div class="navigation-header">
                <div class="nav-breadcrumb">
                    <span class="nav-breadcrumb-item" id="navHome">
                        <i class="fas fa-home"></i> Accueil
                    </span>
                    <span class="nav-breadcrumb-separator" id="navSep1" style="display: none;">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="nav-breadcrumb-item" id="navCategory" style="display: none;">
                        <i class="fas fa-list"></i> <span id="navCategoryName"></span>
                    </span>
                    <span class="nav-breadcrumb-separator" id="navSep2" style="display: none;">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="nav-breadcrumb-item" id="navBrand" style="display: none;">
                        <i class="fas fa-bookmark"></i> <span id="navBrandName"></span>
                    </span>
                </div>
                <button class="nav-back-btn" id="navBackBtn" style="display: none;">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
            </div>

            <!-- Grille dynamique -->
            <div class="products-grid" id="dynamicGrid">
                <!-- Le contenu sera généré par JavaScript -->
            </div>
        </div>

    </div>

    <div class="barcode-keypad-overlay" id="barcodeKeypadOverlay">
        <div class="barcode-keypad-popup">
            <div class="barcode-keypad-header">
                <h3><i class="fas fa-barcode"></i> Entrer Code Produit</h3>
                <p>Saisissez le code-barres</p>
            </div>

            <div class="barcode-display" id="barcodeDisplay"></div>

            <div class="barcode-keypad-grid">
                <button class="barcode-keypad-btn" data-number="1">1</button>
                <button class="barcode-keypad-btn" data-number="2">2</button>
                <button class="barcode-keypad-btn" data-number="3">3</button>
                <button class="barcode-keypad-btn" data-number="4">4</button>
                <button class="barcode-keypad-btn" data-number="5">5</button>
                <button class="barcode-keypad-btn" data-number="6">6</button>
                <button class="barcode-keypad-btn" data-number="7">7</button>
                <button class="barcode-keypad-btn" data-number="8">8</button>
                <button class="barcode-keypad-btn" data-number="9">9</button>
                <button class="barcode-keypad-btn" data-number="0">0</button>
                <button class="barcode-keypad-btn barcode-keypad-special" data-action="clear">
                    <i class="fas fa-backspace"></i> Effacer
                </button>
            </div>

            <div class="barcode-keypad-actions">
                <button class="barcode-keypad-action-btn btn-cancel" id="barcodeCancelBtn">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button class="barcode-keypad-action-btn btn-confirm" id="barcodeConfirmBtn">
                    <i class="fas fa-search"></i> Rechercher
                </button>
            </div>
        </div>
    </div>

    <!-- Keypad Popup -->
    <div class="keypad-overlay" id="keypadOverlay">
        <div class="keypad-popup">
            <div class="keypad-header">
                <h3><i class="fas fa-calculator"></i> Entrer la Quantité</h3>
                <p>Saisissez la quantité désirée</p>
            </div>

            <div class="quantity-display" id="quantityDisplay">1</div>

            <div class="keypad-grid">
                <button class="keypad-btn" data-number="1">1</button>
                <button class="keypad-btn" data-number="2">2</button>
                <button class="keypad-btn" data-number="3">3</button>
                <button class="keypad-btn" data-number="4">4</button>
                <button class="keypad-btn" data-number="5">5</button>
                <button class="keypad-btn" data-number="6">6</button>
                <button class="keypad-btn" data-number="7">7</button>
                <button class="keypad-btn" data-number="8">8</button>
                <button class="keypad-btn" data-number="9">9</button>
                <button class="keypad-btn" data-number="0">0</button>
                <button class="keypad-btn keypad-special" data-action="clear">
                    <i class="fas fa-backspace"></i> Effacer
                </button>
            </div>

            <div class="keypad-actions">
                <button class="keypad-action-btn btn-cancel" id="cancelBtn">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button class="keypad-action-btn btn-confirm" id="confirmBtn">
                    <i class="fas fa-check"></i> Confirmer
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">

                <!-- Header -->
                <div class="modal-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-file-invoice"></i> Facture de Vente
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <p><strong><i class="fas fa-receipt text-success"></i> N° Facture:</strong>
                            <span id="invoiceNumber" class="text-success fw-bold">RRF-22-3056</span>
                        </p>
                        <p><strong><i class="fas fa-calendar text-info"></i> Date:</strong>
                            <span id="invoiceDate" class="text-primary fw-bold"></span>
                        </p>
                    </div>

                    <table class="table table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Produit</th>
                                <th>Prix Unit.</th>
                                <th>Qté</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceProductsTable"></tbody>
                        <tfoot>
                            <tr style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                                <td colspan="3" class="text-end fw-bold">TOTAL :</td>
                                <td class="text-center fw-bold"><span id="invoiceTotalAmount"></span> DH</td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- Payment Method Selection -->
                    <div class="payment-method-section">
                        <div class="payment-method-title">
                            <i class="fas fa-credit-card"></i>
                            Sélectionnez la méthode de paiement
                        </div>

                        <div class="payment-methods-grid">
                            <!-- Espèces -->
                            <div class="payment-method-option">
                                <input type="radio" id="payment-cash" name="payment-method" value="cash" checked>
                                <label for="payment-cash" class="payment-method-label">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-money-bill-wave text-success"></i>
                                    </div>
                                    <div class="payment-method-name">Espèces</div>
                                </label>
                                <div class="payment-method-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>

                            <!-- Carte -->
                            <div class="payment-method-option">
                                <input type="radio" id="payment-card" name="payment-method" value="card">
                                <label for="payment-card" class="payment-method-label">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-credit-card text-primary"></i>
                                    </div>
                                    <div class="payment-method-name">Carte bancaire</div>
                                </label>
                                <div class="payment-method-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>

                            <!-- Virement -->
                            <div class="payment-method-option">
                                <input type="radio" id="payment-transfer" name="payment-method" value="transfer">
                                <label for="payment-transfer" class="payment-method-label">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-exchange-alt text-warning"></i>
                                    </div>
                                    <div class="payment-method-name">Virement</div>
                                </label>
                                <div class="payment-method-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-muted mt-3 border-top pt-3">
                        <i class="fas fa-heart text-danger"></i> Merci pour votre achat !
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light justify-content-center">
                    <button type="button" id="finishSaleBtn" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Terminer
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- <script src="../js/frameWork/bootstrap.js"></script> -->
    <script src="../js/global-time.js"></script>
    <script src="../js/frameWork/jquery-3.7.1.js"></script>


    <script>
        // ====================================================================
        // VARIABLES GLOBALES
        // ====================================================================
        const keypadOverlay = document.getElementById('keypadOverlay');
        const quantityDisplay = document.getElementById('quantityDisplay');
        const addBtn = document.getElementById('addBtn');
        const editBtn = document.getElementById('editBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const viderBtn = document.getElementById('viderBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');

        const barcodeKeypadOverlay = document.getElementById('barcodeKeypadOverlay');
        const barcodeDisplay = document.getElementById('barcodeDisplay');
        const barcodeCancelBtn = document.getElementById('barcodeCancelBtn');
        const barcodeConfirmBtn = document.getElementById('barcodeConfirmBtn');
        const productCodeInput = document.querySelector('input[name="product_code"]');

        const factureTbody = document.getElementById('factureTbody');
        const factureTotal = document.querySelector('.total-amount');

        let currentQuantity = '0';
        let currentBarcode = '';
        let totalGlobal = 0;
        let selectedProduct = null;
        let currentAction = null; // 'add', 'edit', 'barcode'
        let currentRow = null; // Pour stocker la ligne en cours d'édition

        // Navigation
        let currentView = 'categories';
        let selectedCategory = null;
        let selectedBrand = null;
        let categoriesData = [];
        let brandsData = [];

        // ====================================================================
        // 🔢 GESTION KEYPAD QUANTITÉ
        // ====================================================================

        // Afficher le keypad
        function showQuantityKeypad(quantity = '1', action = 'add', row = null) {
            currentQuantity = quantity;
            currentAction = action;
            currentRow = row;
            quantityDisplay.textContent = currentQuantity;
            keypadOverlay.classList.add('show');
        }

        // Masquer le keypad
        function hideQuantityKeypad() {
            keypadOverlay.classList.remove('show');
            currentAction = null;
            currentRow = null;
            selectedProduct = null;
        }

        // Bouton "Ajouter" - Ouvre le barcode keypad
        addBtn.addEventListener('click', () => {
            currentBarcode = '';
            barcodeDisplay.textContent = '';
            barcodeKeypadOverlay.classList.add('show');
        });

        // Bouton "Annuler" du keypad quantité
        cancelBtn.addEventListener('click', hideQuantityKeypad);

        // Clic à l'extérieur du keypad quantité
        keypadOverlay.addEventListener('click', (e) => {
            if (e.target === keypadOverlay) {
                hideQuantityKeypad();
            }
        });

        // Gestion des boutons du keypad quantité
        document.querySelectorAll('.keypad-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.dataset.number) {
                    if (currentQuantity === '0') {
                        currentQuantity = btn.dataset.number;
                    } else if (currentQuantity.length < 4) {
                        currentQuantity += btn.dataset.number;
                    }
                    quantityDisplay.textContent = currentQuantity;
                } else if (btn.dataset.action === 'clear') {
                    if (currentQuantity.length > 1) {
                        currentQuantity = currentQuantity.slice(0, -1);
                    } else {
                        currentQuantity = '0';
                    }
                    quantityDisplay.textContent = currentQuantity;
                }
            });
        });
        // Bouton "Confirmer" du keypad quantité
        confirmBtn.addEventListener('click', () => {
            const qte = parseInt(currentQuantity);

            if (isNaN(qte) || qte <= 0) {
                alert("❗ Impossible d'entrer une quantité inférieure ou égale à 0");
                return;
            }

            if (currentAction === 'add') {
                addProductToFacture(selectedProduct, qte);
            } else if (currentAction === 'edit') {
                updateProductQuantity(currentRow, qte);
            } else if (currentAction === 'barcode') {
                addProductToFacture(selectedProduct, qte);
            }

            hideQuantityKeypad();
        });

        // ====================================================================
        // 📱 GESTION KEYPAD CODE-BARRES
        // ====================================================================

        // Afficher le keypad barcode
        productCodeInput.addEventListener('click', () => {
            currentBarcode = productCodeInput.value || '';
            barcodeDisplay.textContent = currentBarcode;
            barcodeKeypadOverlay.classList.add('show');
        });

        // Masquer le keypad barcode
        barcodeCancelBtn.addEventListener('click', () => {
            barcodeKeypadOverlay.classList.remove('show');
        });

        // Clic à l'extérieur du keypad barcode
        barcodeKeypadOverlay.addEventListener('click', (e) => {
            if (e.target === barcodeKeypadOverlay) {
                barcodeKeypadOverlay.classList.remove('show');
            }
        });

        // Gestion des boutons du keypad barcode
        document.querySelectorAll('.barcode-keypad-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.dataset.number) {
                    if (currentBarcode.length < 13) {
                        currentBarcode += btn.dataset.number;
                    }
                    barcodeDisplay.textContent = currentBarcode;
                } else if (btn.dataset.action === 'clear') {
                    if (currentBarcode.length > 0) {
                        currentBarcode = currentBarcode.slice(0, -1);
                        barcodeDisplay.textContent = currentBarcode;
                    }
                }
            });
        });

        // Bouton "Rechercher" du keypad barcode
        barcodeConfirmBtn.addEventListener('click', () => {
            if (!currentBarcode) {
                alert("❗ Veuillez entrer un code produit");
                return;
            }

            productCodeInput.value = currentBarcode;
            barcodeKeypadOverlay.classList.remove('show');

            $.ajax({
                method: "POST",
                url: "./AJAX/product_code_ajax.php",
                dataType: "json",
                data: {
                    barcode: currentBarcode
                },
                success: function(product) {
                    if (product && product.id) {
                        selectedProduct = product;
                        showQuantityKeypad('1', 'barcode');
                    } else {
                        alert("❗ Produit introuvable avec ce code");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erreur AJAX:", error);
                    alert("❌ Erreur lors de la recherche du produit");
                }
            });
        });

        // ====================================================================
        // 🧾 GESTION DE LA FACTURE
        // ====================================================================

        // Vérifier si le produit existe déjà dans la facture
        function findProductInFacture(productId) {
            let foundRow = null;
            factureTbody.querySelectorAll("tr").forEach(tr => {
                const id = parseInt(tr.children[0].textContent);
                if (id === productId) {
                    foundRow = tr;
                }
            });
            return foundRow;
        }

        // Ajouter un produit à la facture
        function addProductToFacture(product, quantity) {
            if (!product || !product.id) {
                alert("❗ Produit invalide");
                return;
            }

            const existingRow = findProductInFacture(product.id);

            if (existingRow) {
                // Le produit existe déjà, on ajoute la quantité
                const quantityCell = existingRow.children[3];
                const totalCell = existingRow.children[4];
                const price = parseFloat(product.selling_price);

                const oldQuantity = parseInt(quantityCell.textContent);
                const newQuantity = oldQuantity + quantity;
                const oldTotal = parseFloat(totalCell.textContent);
                const newTotal = price * newQuantity;

                quantityCell.textContent = newQuantity;
                totalCell.textContent = newTotal.toFixed(2);

                totalGlobal = totalGlobal - oldTotal + newTotal;
            } else {
                // Nouveau produit
                const total = product.selling_price * quantity;
                const row = document.createElement('tr');
                row.innerHTML = `
          <td style="display:none;">${product.id}</td>
          <td>${product.name}</td>
          <td>${parseFloat(product.selling_price).toFixed(2)}</td>
          <td>${quantity}</td>
          <td>${total.toFixed(2)}</td>
      `;
                factureTbody.appendChild(row);
                totalGlobal += total;
            }

            updateTotalDisplay();
            console.log("✅ Produit ajouté/mis à jour dans la facture");
        }

        // Mettre à jour la quantité d'un produit
        function updateProductQuantity(row, newQuantity) {
            if (!row) return;

            const priceCell = row.children[2];
            const quantityCell = row.children[3];
            const totalCell = row.children[4];

            const price = parseFloat(priceCell.textContent);
            const oldTotal = parseFloat(totalCell.textContent);
            const newTotal = price * newQuantity;

            quantityCell.textContent = newQuantity;
            totalCell.textContent = newTotal.toFixed(2);

            totalGlobal = totalGlobal - oldTotal + newTotal;
            updateTotalDisplay();

            console.log("✅ Quantité mise à jour");
        }

        // Mettre à jour l'affichage du total
        function updateTotalDisplay() {
            if (factureTotal) {
                factureTotal.textContent = totalGlobal.toFixed(2) + " DH";
            }
        }

        // ====================================================================
        // 🎯 SÉLECTION DE LIGNE DANS LA FACTURE
        // ====================================================================

        // Sélectionner une ligne (clic simple)
        factureTbody.addEventListener('click', (e) => {
            const row = e.target.closest('tr');
            if (row) {
                factureTbody.querySelectorAll('tr').forEach(tr => tr.classList.remove('selected'));
                row.classList.add('selected');
            }
        });

        // Désélectionner une ligne (double-clic)
        factureTbody.addEventListener('dblclick', (e) => {
            const row = e.target.closest('tr');
            if (row) {
                row.classList.remove('selected');
            }
        });

        // ====================================================================
        // ✏️ MODIFIER LA QUANTITÉ
        // ====================================================================

        editBtn.addEventListener('click', () => {
            const selectedRow = factureTbody.querySelector('tr.selected');
            if (!selectedRow) {
                alert("❗ Veuillez sélectionner une ligne à modifier");
                return;
            }

            const currentQty = selectedRow.children[3].textContent;
            showQuantityKeypad(currentQty, 'edit', selectedRow);
        });

        // ====================================================================
        // 🗑️ SUPPRIMER UN PRODUIT
        // ====================================================================

        deleteBtn.addEventListener('click', () => {
            const selectedRow = factureTbody.querySelector('tr.selected');
            if (!selectedRow) {
                alert("❗ Veuillez sélectionner une ligne à supprimer");
                return;
            }

            const totalCell = selectedRow.children[4];
            const rowTotal = parseFloat(totalCell.textContent);

            selectedRow.remove();

            totalGlobal -= rowTotal;
            updateTotalDisplay();

            console.log("✅ Produit supprimé");
        });

        // ====================================================================
        // 🧹 VIDER LA FACTURE
        // ====================================================================

        viderBtn.addEventListener('click', () => {
            if (factureTbody.children.length === 0) {
                alert("❗ La facture est déjà vide");
                return;
            }

            const confirmation = confirm("🗑️ Êtes-vous sûr de vouloir vider toute la facture ?");
            if (!confirmation) return;

            factureTbody.innerHTML = '';
            totalGlobal = 0;
            updateTotalDisplay();

            console.log("✅ Facture vidée");
        });

        // ====================================================================
        // 📦 NAVIGATION - CATÉGORIES
        // ====================================================================

        function showCategories() {
            currentView = 'categories';
            updateBreadcrumb();
            const grid = document.getElementById('dynamicGrid');
            grid.innerHTML = '';

            $.ajax({
                method: "POST",
                url: "./AJAX/categorie_ajax.php",
                dataType: "json",
                success: function(categories) {
                    categoriesData = categories;
                    categories.forEach(category => {
                        const categoryCard = createCategoryCard(category);
                        grid.appendChild(categoryCard);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Erreur catégories:", error);
                    alert("❌ Erreur lors du chargement des catégories");
                }
            });
        }

        function createCategoryCard(category) {
            const card = document.createElement('div');
            card.className = 'product-card category-card';
            card.innerHTML = `
      <div class="product-image">
          <img src="../categories-img/${category.image}" 
               alt="${category.name}" 
               onerror="this.style.display='none'">
      </div>
      <div class="product-name">${category.name}</div>
  `;
            card.addEventListener('click', () => showBrands(category.id));
            return card;
        }

        // ====================================================================
        // 🏷️ NAVIGATION - MARQUES
        // ====================================================================

        function showBrands(categoryId) {
            currentView = 'brands';
            selectedCategory = categoriesData.find(c => c.id == categoryId);
            updateBreadcrumb();
            const grid = document.getElementById('dynamicGrid');
            grid.innerHTML = '';

            $.ajax({
                method: "POST",
                url: "./AJAX/brands_ajax.php",
                data: {
                    category_id: categoryId
                },
                dataType: "json",
                success: function(brands) {
                    brandsData = brands;
                    brands.forEach(brand => {
                        const brandCard = createBrandCard(brand);
                        grid.appendChild(brandCard);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Erreur marques:", error);
                    alert("❌ Erreur lors du chargement des marques");
                }
            });
        }

        function createBrandCard(brand) {
            const card = document.createElement('div');
            card.className = 'product-card brand-card';
            card.innerHTML = `
      <div class="product-image">
          <img src="../imgs/brands-img/${brand.name.toLowerCase()}.png" 
               alt="${brand.name}" 
               onerror="this.style.display='none'">
      </div>
      <div class="product-name">${brand.name}</div>
  `;
            card.addEventListener('click', () => showProducts(brand.id));
            return card;
        }

        // ====================================================================
        // 🛍️ NAVIGATION - PRODUITS
        // ====================================================================

        function showProducts(brandId) {
            currentView = 'products';
            selectedBrand = brandsData.find(b => b.id == brandId);
            updateBreadcrumb();
            const grid = document.getElementById('dynamicGrid');
            grid.innerHTML = '';

            $.ajax({
                method: "POST",
                url: "./AJAX/products_ajax.php",
                data: {
                    brand_id: brandId
                },
                dataType: "json",
                success: function(products) {
                    products.forEach(product => {
                        const productCard = createProductCard(product);
                        grid.appendChild(productCard);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Erreur produits:", error);
                    alert("❌ Erreur lors du chargement des produits");
                }
            });
        }

        function createProductCard(product) {
            const card = document.createElement('div');
            card.className = 'product-card';
            card.innerHTML = `
      <div class="product-image">
          <img src="../products-img/${product.image}" 
               alt="${product.name}" 
               onerror="this.style.display='none'">
      </div>
      <div class="product-name">${product.name}</div>
      <div class="product-price">${product.selling_price} DH</div>
  `;

            card.addEventListener('click', () => {
                selectedProduct = product;
                showQuantityKeypad('1', 'add');
            });

            return card;
        }

        // ====================================================================
        // 🧭 BREADCRUMB
        // ====================================================================

        function updateBreadcrumb() {
            const navHome = document.getElementById('navHome');
            const navSep1 = document.getElementById('navSep1');
            const navCategory = document.getElementById('navCategory');
            const navCategoryName = document.getElementById('navCategoryName');
            const navSep2 = document.getElementById('navSep2');
            const navBrand = document.getElementById('navBrand');
            const navBrandName = document.getElementById('navBrandName');
            const backBtn = document.getElementById('navBackBtn');

            [navSep1, navCategory, navSep2, navBrand].forEach(el => el.style.display = 'none');
            backBtn.style.display = 'none';

            if (currentView === 'brands') {
                navSep1.style.display = 'inline';
                navCategory.style.display = 'inline';
                navCategoryName.textContent = selectedCategory.name;
                backBtn.style.display = 'inline-block';
            } else if (currentView === 'products') {
                navSep1.style.display = 'inline';
                navCategory.style.display = 'inline';
                navCategoryName.textContent = selectedCategory.name;
                navSep2.style.display = 'inline';
                navBrand.style.display = 'inline';
                navBrandName.textContent = selectedBrand.name;
                backBtn.style.display = 'inline-block';
            }
        }

        document.getElementById('navHome').addEventListener('click', showCategories);
        document.getElementById('navCategory').addEventListener('click', () => {
            if (selectedCategory) showBrands(selectedCategory.id);
        });
        document.getElementById('navBackBtn').addEventListener('click', () => {
            if (currentView === 'brands') {
                showCategories();
            } else if (currentView === 'products') {
                showBrands(selectedCategory.id);
            }
        });

        // ====================================================================
        // ✅ FINALISER LA VENTE (Sans Bootstrap)
        // ====================================================================

        const btnComplete = document.querySelector('.btn-complete');
        const invoiceModal = document.getElementById('invoiceModal');

        if (btnComplete) {
            btnComplete.addEventListener('click', () => {
                if (factureTbody.children.length === 0) {
                    alert("❗ La facture est vide ! Veuillez ajouter des produits.");
                    return;
                }

                // Mise à jour de la date
                const now = new Date();
                document.getElementById('invoiceDate').textContent =
                    now.toLocaleDateString('fr-FR') + ' ' + now.toLocaleTimeString('fr-FR');

                // Remplir le tableau de la facture
                const invoiceTable = document.getElementById('invoiceProductsTable');
                invoiceTable.innerHTML = '';
                factureTbody.querySelectorAll('tr').forEach(row => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = row.innerHTML;
                    newRow.classList.remove('selected');
                    invoiceTable.appendChild(newRow);
                });

                document.getElementById('invoiceTotalAmount').textContent = totalGlobal.toFixed(2);

                // Afficher le modal (sans Bootstrap)
                invoiceModal.style.display = 'flex';
            });
        }

        // Fermer le modal avec le bouton X
        const closeModalBtn = invoiceModal?.querySelector('.btn-close');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                invoiceModal.style.display = 'none';
            });
        }

        // Fermer le modal en cliquant à l'extérieur
        if (invoiceModal) {
            invoiceModal.addEventListener('click', (e) => {
                if (e.target === invoiceModal) {
                    invoiceModal.style.display = 'none';
                }
            });
        }

        // Bouton "Terminer"
        const finishSaleBtnEl = document.getElementById('finishSaleBtn');
        if (finishSaleBtnEl) {
            finishSaleBtnEl.addEventListener('click', () => {
                // Vider la facture
                factureTbody.innerHTML = '';
                totalGlobal = 0;
                updateTotalDisplay();

                // Fermer le modal
                invoiceModal.style.display = 'none';

                alert("✅ Vente terminée avec succès !");
            });
        }

        // ====================================================================
        // 🚀 INITIALISATION
        // ====================================================================

        document.addEventListener('DOMContentLoaded', () => {
            showCategories();
            console.log("✅ Système POS initialisé");
        });
    </script>

</body>

</html>
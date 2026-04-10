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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/caisse.css">
    <link rel="stylesheet" href="../css/global.css">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">✕</button>
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
                                <td colspan="2" class="text-end fw-bold">TOTAL :</td>
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



    <script src="../js/global-time.js"></script>
    <script src="../js/frameWork/jquery-3.7.1.js"></script>


    <script>
        //==========================
        //Decliration of all IDs
        //======================

        // Keypad quantite
        const keypadOverlay = document.getElementById('keypadOverlay');
        const quantityDisplay = document.getElementById('quantityDisplay');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');

        // Barcode keypad
        const barcodeKeypadOverlay = document.getElementById('barcodeKeypadOverlay');
        const barcodeDisplay = document.getElementById('barcodeDisplay');
        const barcodeCancelBtn = document.getElementById('barcodeCancelBtn');
        const barcodeConfirmBtn = document.getElementById('barcodeConfirmBtn');
        const productCodeInput = document.querySelector('input[name="product_code"]');

        // Boutons action
        const addBtn = document.getElementById('addBtn');
        const editBtn = document.getElementById('editBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const viderBtn = document.getElementById('viderBtn');

        // Facture
        const factureTbody = document.getElementById('factureTbody');
        const factureTotal = document.querySelector('.total-amount');

        // Navigation
        const navHome = document.getElementById('navHome');
        const navSep1 = document.getElementById('navSep1');
        const navCategory = document.getElementById('navCategory');
        const navCategoryName = document.getElementById('navCategoryName');
        const navSep2 = document.getElementById('navSep2');
        const navBrand = document.getElementById('navBrand');
        const navBrandName = document.getElementById('navBrandName');
        const backBtn = document.getElementById('navBackBtn');

        // Grid
        const dynamicGrid = document.getElementById('dynamicGrid');

        // Modal
        const invoiceModal = document.getElementById('invoiceModal');
        const invoiceDate = document.getElementById('invoiceDate');
        const invoiceProductsTable = document.getElementById('invoiceProductsTable');
        const invoiceTotalAmount = document.getElementById('invoiceTotalAmount');
        const finishSaleBtn = document.getElementById('finishSaleBtn');


        //=============================
        //Declaration for all variables
        //=============================

        let currentQuantity = '0';
        let currentAction = null; //add,edit,barcode
        let currentRow = null;

        let currentBarcode = '';

        let selectedProduct = null;

        let totalGlobal = 0;

        let currentView = 'categories';
        let selectedCategory = null;
        let selectedBrand = null;
        let categoriesData = [];
        let brandsData = [];

        //================================
        //Initialisation of all functions
        //================================


        function showQuantityKeypad(quantity, action, row) {} //good

        function hideQuantityKeypad() {} //good

        function updateTotalDisplay() {} //good

        function findProductInFacture(productId) {} //good

        function addProductToFacture(product, quantity) {} //good

        function updateProductQuantity(row, newQuantity) {} //good

        function showCategories() {} //good

        function showBrands(categoryId) {} //good

        function showProducts(brandId) {} //good

        function createCategoryCard(category) {} //good

        function createBrandCard(brand) {} //good

        function createProductCard(product) {} //good

        function updateBreadcrumb() {} //


        //===================
        // The start of code 
        //===================

        function showQuantityKeypad(quantity, action, row) {
            currentQuantity = quantity;
            currentAction = action;
            currentRow = row;
            quantityDisplay.textContent = currentQuantity;
            keypadOverlay.classList.add("show");
        }

        function hideQuantityKeypad() {
            keypadOverlay.classList.remove("show");
            currentQuantity = '0';
            currentAction = null;
            currentRow = null;
        }

        function updateTotalDisplay() {
            factureTotal.textContent = totalGlobal.toFixed(2) + " DH";
        }

        function findProductInFacture(productId) {
            let foundRow = null;
            factureTbody.querySelectorAll("tr").forEach(tr => {
                if (productId === parseInt(tr.children[0].textContent)) {
                    foundRow = tr;
                }
            })
            return foundRow;
        }

        function addProductToFacture(product, quantity) {
            let productFouder = findProductInFacture(product.id);
            if (productFouder !== null) {
                updateProductQuantity(productFouder, quantity)
            } else {
                let newProduct = document.createElement("tr");
                let productTotal = parseInt(quantity) * parseFloat(product.selling_price);
                newProduct.innerHTML = `
                    <td style="display:none;">${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.selling_price.toFixed(2)}</td>
                    <td>${quantity}</td>
                    <td>${productTotal.toFixed(2)}</td>
                `
                totalGlobal += productTotal;
                factureTbody.appendChild(newProduct);
                updateTotalDisplay();
            }
        }

        function updateProductQuantity(row, newQuantity) {
            console.log(row);
            console.log(newQuantity);
            let productPrice = row.children[2].textContent;
            let oldQuantity = row.children[3];
            let oldProductTotal = row.children[4];

            oldQuantity.textContent = newQuantity;
            let NewProductTotal = parseInt(newQuantity) * parseFloat(productPrice);

            totalGlobal = (totalGlobal - parseFloat(oldProductTotal.textContent)) + parseFloat(NewProductTotal);
            updateTotalDisplay();

            oldProductTotal.textContent = NewProductTotal.toFixed(2);
        }

        function showCategories() {
            currentView = 'categories';
            updateBreadcrumb();
            dynamicGrid.innerHTML = '';

            $.ajax({
                method: "POST",
                dataType: "json",
                url: "./AJAX/categorie_ajax.php",
                success: function(categories, textStatus, XHR) {
                    // To put all categories in one table 
                    categoriesData = categories;
                    categories.forEach((category) => {
                        dynamicGrid.appendChild(createCategoryCard(category));
                    })
                }
            })
        }

        function showBrands(categoryId) {
            selectedCategory = categoriesData.find(c => c.id == categoryId)
            currentView = 'brands';
            updateBreadcrumb();
            dynamicGrid.innerHTML = '';

            $.ajax({
                method: "POST",
                dataType: "json",
                url: "./AJAX/brands_ajax.php",
                data: {
                    category_id: categoryId,
                },
                success: function(brands, textStatus, XHR) {
                    brandsData = brands;
                    brands.forEach((brand) => {
                        dynamicGrid.appendChild(createBrandCard(brand));
                    })
                }
            })
        }


        function showProducts(brandId) {
            selectedBrand = brandsData.find(b => b.id == brandId)
            currentView = 'brands';
            updateBreadcrumb();
            dynamicGrid.innerHTML = '';

            $.ajax({
                method: "POST",
                dataType: "json",
                url: "./AJAX/products_ajax.php",
                data: {
                    brand_id: brandId,
                },
                success: function(products, textStatus, XHR) {
                    products.forEach((product) => {
                        dynamicGrid.appendChild(createProductCard(product));
                    })
                }
            })
        }

        function createCategoryCard(category) {
            let card = document.createElement("div");
            card.className = 'product-card category-card';
            card.innerHTML = `
                <div class="product-image">
                    <img src="../categories-img/${category.image}" 
                        alt="${category.name}" 
                        onerror="this.style.display='none'">   
                </div>
                <div class="product-name">${category.name}</div>
            `;
            card.addEventListener('click', () => showBrands(category.id))
            return card;
        }

        function createBrandCard(brand) {
            let card = document.createElement("div");
            card.className = 'product-card brand-card';
            card.innerHTML = `
                <div class="product-image">
                    <img src="../brands-img/${brand.image}" 
                        alt="${brand.name}" 
                        onerror="this.style.display='none'">
                </div>
                <div class="product-name">${brand.name}</div>
            `;
            card.addEventListener('click', () => showProducts(brand.id));
            return card;
        }

        function createProductCard(product) {
            let card = document.createElement("div");
            card.className = 'product-card';
            card.innerHTML = `
                <div class="product-image">
                    <img src="../products-img/${product.image}" 
                        alt="${product.name}" 
                        onerror="this.style.display='none'">
                </div>
                <div class="product-name">${product.name}</div>
                <div class="product-price">${product.selling_price.toFixed(2)} DH</div>
            `;

            card.addEventListener('click', () => {
                selectedProduct = product;
                let productFouder = findProductInFacture(product.id);
                console.log(productFouder);
                if (productFouder !== null) {
                    let ProductFouderQuantity = productFouder.children[3].textContent;
                    showQuantityKeypad(ProductFouderQuantity, 'edit', productFouder);
                } else {
                    showQuantityKeypad('1', 'add');
                }
            })
            return card;
        }


        function updateBreadcrumb() {
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


        //==================================
        // Buttons and EventListener
        //==================================

        confirmBtn.addEventListener('click', () => {
            let qte = parseInt(currentQuantity);

            if (isNaN(qte) || qte <= 0) {
                alert("❗ Impossible d'entrer une quantité inférieure ou égale à 0");
                return;
            }

            if (currentAction == 'add') {
                addProductToFacture(selectedProduct, qte);
            } else if (currentAction == 'edit') {
                updateProductQuantity(currentRow, qte)
            } else if (currentAction == 'barcode') {
                addProductToFacture(selectedProduct, qte);
            }

            hideQuantityKeypad();
        })

        addBtn.addEventListener('click', () => {
            currentBarcode = '';
            barcodeDisplay.textContent = '';
            barcodeKeypadOverlay.classList.add('show');
        });

        cancelBtn.addEventListener('click', hideQuantityKeypad);

        keypadOverlay.addEventListener('click', (e) => {
            if (e.target === keypadOverlay) {
                hideQuantityKeypad();
            }
        });

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

        productCodeInput.addEventListener('click', () => {
            currentBarcode = productCodeInput.value || '';
            barcodeDisplay.textContent = currentBarcode;
            barcodeKeypadOverlay.classList.add('show');
        });

        barcodeCancelBtn.addEventListener('click', () => {
            barcodeKeypadOverlay.classList.remove('show');
        });

        barcodeKeypadOverlay.addEventListener('click', (e) => {
            if (e.target === barcodeKeypadOverlay) {
                barcodeKeypadOverlay.classList.remove('show');
            }
        });

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

        barcodeConfirmBtn.addEventListener('click', () => {
            if (!currentBarcode) {
                alert("Veuillez entrer un code produit");
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
                        alert("Produit introuvable avec ce code");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erreur AJAX:", error);
                    alert("Erreur lors de la recherche du produit");
                }
            });
        });


        // Selection for a product in facture (one click)
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


        editBtn.addEventListener('click', () => {
            const selectedRow = factureTbody.querySelector('tr.selected');
            if (!selectedRow) {
                alert("❗ Veuillez sélectionner une ligne à modifier");
                return;
            }

            const currentQty = selectedRow.children[3].textContent;
            showQuantityKeypad(currentQty, 'edit', selectedRow);
        });

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


        navHome.addEventListener('click', showCategories);
        navCategory.addEventListener('click', () => {
            if (selectedCategory) showBrands(selectedCategory.id);
        });
        backBtn.addEventListener('click', () => {
            if (currentView === 'brands') {
                showCategories();
            } else if (currentView === 'products') {
                showBrands(selectedCategory.id);
            }
        });




        // ✅ فتح الـ modal مع أنيميشن
        function openInvoiceModal() {
            invoiceModal.style.display = 'flex';
            invoiceModal.classList.add('show');
        }

        // ✅ إغلاق الـ modal مع أنيميشن
        function closeInvoiceModal() {
            invoiceModal.classList.remove('show');
            invoiceModal.style.display = 'none';
        }

        // ✅ زر إتمام البيع
        const btnComplete = document.querySelector('.btn-complete');
        if (btnComplete) {
            btnComplete.addEventListener('click', () => {
                if (factureTbody.children.length === 0) {
                    alert("❗ La facture est vide ! Veuillez ajouter des produits.");
                    return;
                }

                // تحديث التاريخ
                const now = new Date();
                invoiceDate.textContent =
                    now.toLocaleDateString('fr-FR') + ' ' + now.toLocaleTimeString('fr-FR');

                // ملء جدول الفاتورة
                const invoiceTable = document.getElementById('invoiceProductsTable');
                invoiceTable.innerHTML = '';
                factureTbody.querySelectorAll('tr').forEach(row => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = row.innerHTML;
                    newRow.classList.remove('selected');
                    invoiceTable.appendChild(newRow);
                });

                document.getElementById('invoiceTotalAmount').textContent = totalGlobal.toFixed(2);

                openInvoiceModal();
            });
        }

        // ✅ إغلاق بزر X
        const closeModalBtn = invoiceModal?.querySelector('.btn-close');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', closeInvoiceModal);
        }

        // ✅ إغلاق بالضغط خارج الـ modal
        if (invoiceModal) {
            invoiceModal.addEventListener('click', (e) => {
                if (e.target === invoiceModal) closeInvoiceModal();
            });
        }

        const finishSaleBtnEl = document.getElementById('finishSaleBtn');
        if (finishSaleBtnEl) {
            finishSaleBtnEl.addEventListener('click', () => {
                factureTbody.innerHTML = '';
                totalGlobal = 0;
                updateTotalDisplay();
                closeInvoiceModal();
                alert("✅ Vente terminée avec succès !");
            });
        }


        document.addEventListener('DOMContentLoaded', () => {
            showCategories();
            console.log("✅ Système POS initialisé");
        });
    </script>

</body>

</html>
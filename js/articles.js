let removeBtn = document.querySelectorAll('.btn-delete');
let editBtn = document.querySelectorAll('.btn-edit');
let productId = document.getElementById('product-id');
let productName = document.getElementById('product-name');
let productImage = document.getElementById('product-image');
let purchasePrice = document.getElementById('purchase-price');
let sellingPrice = document.getElementById('selling-price');
let stockQuantity = document.getElementById('stock-quantity');
let Barcode = document.getElementById('barcode');
let productBrand = document.getElementById('product-brand');
let productCategory = document.getElementById('product-category');
let addProduct = document.getElementById('addProduct');
let updateProduct = document.getElementById('updateProduct');

editBtn.forEach(btn =>{
    btn.addEventListener('click',()=>{
        let tr = btn.closest('.product');
        let id = tr.children[0].textContent.trim();
        let name = tr.children[1].textContent.trim();
        let image =  tr.children[2].querySelector('.product-image').getAttribute('src');
        let purPrice = tr.children[3].textContent.trim();
        let sellPrice = tr.children[4].textContent.trim();
        let stock = tr.children[4].textContent.trim();
        let barcode = tr.children[5].textContent.trim();
        let brand = btn.dataset.brand;
        let category = btn.dataset.category;

        productId.value = id;
        productName.value = name;
        purchasePrice.value = purPrice;
        sellingPrice.value = sellPrice;
        stockQuantity.value = stock;
        Barcode.value = barcode;
        productBrand.value = brand;
        productCategory.value = category;

        document.getElementById('imagePreview').innerHTML = `<img src="${image}" style="width:140px;border-radius:10px;">`;

        document.querySelectorAll('.product').forEach(row => row.classList.remove('selected'));
        tr.classList.add('selected');

        updateProduct.disabled = false;
        updateProduct.opacity = 1;
        updateProduct.cursor = 'pointer';

        addProduct.disabled = true;
        addProduct.opacity = '0.6';
        addProduct.cursor = 'not-allowed';

    })
})

editBtn.forEach(btn =>{
    btn.addEventListener('dblclick',()=>{
        let tr = btn.closest('.product');
        let id = tr.children[0].textContent.trim();
        let name = tr.children[1].textContent.trim();
        let image =  tr.children[2].querySelector('.product-image').getAttribute('src');
        let purPrice = tr.children[3].textContent.trim();
        let sellPrice = tr.children[4].textContent.trim();
        let stock = tr.children[4].textContent.trim();
        let barcode = tr.children[5].textContent.trim();
        let brand = btn.dataset.brand;
        let category = btn.dataset.category;

        productId.value = '';
        productName.value = '';
        purchasePrice.value = '';
        sellingPrice.value = '';
        stockQuantity.value = '';
        Barcode.value = '';
        productBrand.value = '';
        productCategory.value = '';

        document.getElementById('imagePreview').innerHTML = ``;

        document.querySelectorAll('.product').forEach(row => row.classList.remove('selected'));
        tr.classList.remove('selected');

        updateProduct.disabled = true;
        updateProduct.opacity = '0.6';
        updateProduct.cursor = 'not-allowed';

        addProduct.disabled = false;
        addProduct.opacity = 1;
        addProduct.cursor = 'pointer';

    })
})

updateProduct.disabled = true;
updateProduct.opacity = '0.6';
updateProduct.cursor = 'not-allowed';

addProduct.disabled = false;
addProduct.opacity = 1;
addProduct.cursor = 'pointer';
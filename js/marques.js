let removeBtn = document.querySelectorAll('.btn-delete');
let editBtn = document.querySelectorAll('.btn-edit');
let brandId = document.getElementById('brand-id');
let brandName = document.getElementById('brand-name');
let brandImage = document.getElementById('brand-image');
let brandCategory = document.getElementById('brand-category');
let addBrand = document.getElementById('addBrand');
let updateBrand = document.getElementById('updateBrand');

editBtn.forEach(btn =>{
    btn.addEventListener('click',()=>{
        let tr = btn.closest('.brand');
        let id = tr.children[0].textContent.trim();
        let name = tr.children[1].textContent.trim();
        let image =  tr.children[2].querySelector('.brand-image').getAttribute('src');
        let category = btn.dataset.category;

        brandId.value = id;
        brandName.value = name;
        brandCategory.value = category;

        document.getElementById('imagePreview').innerHTML = `<img src="${image}" style="width:140px;border-radius:10px;">`;

        document.querySelectorAll('.brand').forEach(row => row.classList.remove('selected'));
        tr.classList.add('selected');

        updateBrand.disabled = false;
        updateBrand.opacity = 1;
        updateBrand.cursor = 'pointer';

        addBrand.disabled = true;
        addBrand.opacity = '0.6';
        addBrand.cursor = 'not-allowed';

    })
})

editBtn.forEach(btn => {
    btn.addEventListener('dblclick',()=>{
        let tr = btn.closest('.brand');
        let id =  tr.children[0].textContent.trim();
        let name = tr.children[1].textContent.trim();
        let image = tr.children[2].querySelector('.brand-image').getAttribute('src');

        brandId.value = '';
        brandName.value = '';

        document.getElementById('imagePreview').innerHTML = ``;

        document.querySelectorAll('.brand').forEach(row => row.classList.remove('selected'));
        

        updateBrand.disabled = true;
        updateBrand.opacity = '0.6';
        updateBrand.cursor = 'not-allowed';

        addBrand.disabled = false;
        addBrand.opacity = 1;
        addBrand.cursor = 'pointer';


    });
});
updateBrand.disabled = true;
updateBrand.opacity = '0.6';
updateBrand.cursor = 'not-allowed';

addBrand.disabled = false;
addBrand.opacity = 1;
addBrand.cursor = 'pointer';

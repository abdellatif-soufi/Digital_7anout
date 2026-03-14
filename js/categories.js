let removeBtn = document.querySelectorAll('.btn-delete');
let editBtn = document.querySelectorAll('.btn-edit');
let categoryId = document.getElementById('category-id');
let categoryName = document.getElementById('category-name');
let categoryImage = document.getElementById('category-image');
let addCategory = document.getElementById('addCategory');
let updateCategory = document.getElementById('updateCategory');

editBtn.forEach(btn => {
    btn.addEventListener('click',()=>{
        let tr = btn.closest('.category');
        let id =  tr.children[0].textContent.trim();
        let name = tr.children[1].textContent.trim();
        let image = tr.children[2].querySelector('.category-image').getAttribute('src');

        categoryId.value = id;
        categoryName.value = name;

        document.getElementById('imagePreview').innerHTML = `<img src="${image}" style="width:140px;border-radius:10px;">`;

        document.querySelectorAll('.category').forEach(row => row.classList.remove('selected'));
        tr.classList.add('selected');

        updateCategory.disabled = false;
        updateCategory.opacity = 1;
        updateCategory.cursor = 'pointer';

        addCategory.disabled = true;
        addCategory.opacity = '0.6';
        addCategory.cursor = 'not-allowed';
    });
});

editBtn.forEach(btn => {
    btn.addEventListener('dblclick',()=>{
        let tr = btn.closest('.category');
        let id =  tr.children[0].textContent.trim();
        let name = tr.children[1].textContent.trim();
        let image = tr.children[2].querySelector('.category-image').getAttribute('src');

        categoryId.value = '';
        categoryName.value = '';

        document.getElementById('imagePreview').innerHTML = ``;

        document.querySelectorAll('.category').forEach(row => row.classList.remove('selected'));
        

        updateCategory.disabled = true;
        updateCategory.opacity = '0.6';
        updateCategory.cursor = 'not-allowed';

        addCategory.disabled = false;
        addCategory.opacity = 1;
        addCategory.cursor = 'pointer';


    });
});
updateCategory.disabled = true;
updateCategory.opacity = '0.6';
updateCategory.cursor = 'not-allowed';

addCategory.disabled = false;
addCategory.opacity = 1;
addCategory.cursor = 'pointer';


const searchInput = document.getElementById('search-input');
const tableRows = document.querySelectorAll('#categories-tbody tr');

searchInput.addEventListener('input', () => {
    const filter = searchInput.value.toLowerCase(); 

    tableRows.forEach(row => {
        const nameCell = row.children[1].textContent.toLowerCase(); 
        if(nameCell.includes(filter)){
            row.style.display = '';
        } else {
            row.style.display = 'none'; 
        }
    });
});

        
        
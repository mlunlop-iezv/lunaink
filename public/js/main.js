//----SCRIPT PARA EL DROPZONE 
const dropZone = document.getElementById('drop-zone');
const inputElement = document.getElementById('fileInput');
const previewThumb = document.getElementById('previewThumb');

// 1. Activar el input file al hacer click en la zona
dropZone.addEventListener('click', () => {
    inputElement.click();
});

// 2. Detectar cuando se selecciona un archivo manualmente
inputElement.addEventListener('change', () => {
    if (inputElement.files.length) {
        updateThumbnail(dropZone, inputElement.files[0]);
    }
});

// 3. Efectos visuales de Drag & Drop
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault(); // Necesario para permitir el drop
    dropZone.classList.add('dragover');
});

['dragleave', 'dragend'].forEach(type => {
    dropZone.addEventListener(type, () => {
        dropZone.classList.remove('dragover');
    });
});

// 4. Manejar el evento DROP (cuando sueltan el archivo)
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('dragover');

    if (e.dataTransfer.files.length) {
        // Asignamos los archivos arrastrados al input real
        inputElement.files = e.dataTransfer.files;
        // Actualizamos la vista previa
        updateThumbnail(dropZone, e.dataTransfer.files[0]);
    }
});

// 5. Función para pintar la imagen en el div
function updateThumbnail(dropZoneElement, file) {
    // Asegurarnos que es una imagen
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
            previewThumb.style.backgroundImage = `url('${reader.result}')`;
            previewThumb.style.display = 'block';
            // Opcional: Poner el nombre del archivo
            previewThumb.dataset.label = file.name;
        };
    } else {
        // Si suben algo que no es imagen
        previewThumb.style.display = 'none';
    }
}


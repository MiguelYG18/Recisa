let fileInput = document.getElementById("file-input");
let fileList = document.getElementById("files-list");
let numOfFiles = document.getElementById("num-of-files");

// Variable global para almacenar todos los archivos seleccionados
let allFiles = [];

fileInput.addEventListener("change", () => {
  let selectedFiles = Array.from(fileInput.files);

  // Filtrar los archivos que ya están en allFiles
  selectedFiles.forEach(file => {
    if (!allFiles.some(existingFile => existingFile.name === file.name && existingFile.size === file.size)) {
      allFiles.push(file);
    }
  });

  // Crear un nuevo DataTransfer para actualizar el input de archivos
  const dataTransfer = new DataTransfer();
  allFiles.forEach(file => dataTransfer.items.add(file));
  fileInput.files = dataTransfer.files;

  updateFileList();
});

function updateFileList() {
  // Limpiar la lista de archivos
  fileList.innerHTML = "";

  // Actualizar el número de archivos seleccionados
  numOfFiles.textContent = `${allFiles.length} archivos seleccionados`;

  // Actualizar la lista de archivos
  allFiles.forEach((file, index) => {
    let listItem = document.createElement("li");
    listItem.style.display = "flex";
    listItem.style.alignItems = "center";
    listItem.style.justifyContent = "space-between";

    let fileName = file.name;
    let fileSize = (file.size / 1024).toFixed(1);
    let fileDetails = document.createElement("div");
    fileDetails.style.display = "flex";
    fileDetails.style.alignItems = "center";
    fileDetails.style.gap = "10px";
    fileDetails.innerHTML = `<p style="margin: 0; align-self: center;">${fileName}</p><p style="margin: 0; align-self: center;">${fileSize}KB</p>`;

    if (fileSize >= 1024) {
      fileSize = (fileSize / 1024).toFixed(1);
      fileDetails.innerHTML = `<p style="margin: 0; align-self: center;">${fileName}</p><p style="margin: 0; align-self: center;">${fileSize}MB</p>`;
    }

    // Crear un contenedor para los botones
    let buttonContainer = document.createElement("div");
    buttonContainer.style.display = "flex";
    buttonContainer.style.gap = "5px";

    let deleteButton = document.createElement("button");
    let icon = document.createElement("i");
    icon.className = "fa-solid fa-trash";
    deleteButton.appendChild(icon);
    deleteButton.appendChild(document.createTextNode(" "));
    deleteButton.addEventListener("click", () => {
      allFiles.splice(index, 1);

      // Crear un nuevo DataTransfer para actualizar el input de archivos
      const dataTransfer = new DataTransfer();
      allFiles.forEach(file => dataTransfer.items.add(file));
      fileInput.files = dataTransfer.files;

      updateFileList();
    });

    // Crear botón de vista previa
    let previewButton = document.createElement("button");
    let previewIcon = document.createElement("i");
    previewIcon.className = "fa-solid fa-eye";
    previewButton.appendChild(previewIcon);
    previewButton.appendChild(document.createTextNode(" ")); // Agrega un espacio antes para separar el icono y el texto
    previewButton.addEventListener("click", () => {
      window.open(URL.createObjectURL(file), '_blank');
    });

    // Agregar los botones al contenedor
    buttonContainer.appendChild(previewButton);
    buttonContainer.appendChild(deleteButton);

    // Agregar el contenedor a la lista
    listItem.appendChild(fileDetails);
    listItem.appendChild(buttonContainer);
    fileList.appendChild(listItem);
  });
}
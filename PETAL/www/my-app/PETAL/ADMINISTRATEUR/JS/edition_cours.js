function AjoutImage() {
    var input = document.createElement('input');
    input.type = 'file';
    input.onchange = e => {
        // Récuparation de la réference du fichier
        const file = e.target.files[0];
      //  window.alert(file.name);
        const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = readerEvent => {
                    const content = readerEvent.target.result;
                    document.querySelector('#ajoutFichier').style.background = '#f88c95';
                    document.querySelector('#ajoutFichier').style.backgroundSize = 'cover';
                    document.querySelector('#ajoutFichier').value = file.name;
                    const b64WithPrefix = reader.result;
                    document.querySelector('#b64Image').value = b64WithPrefix.substring(b64WithPrefix.indexOf(',') + 1);
                }

    }
    input.click();
}

const box
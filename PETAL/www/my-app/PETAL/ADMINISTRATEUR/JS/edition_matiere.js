function AjoutImageFichier() {
    var input = document.createElement('input');
    input.type = 'file';
    input.onchange = e => {
        // Récuparation de la réference du fichier
        const file = e.target.files[0];

        // Check size
        const fsize = file.size;
        if (fsize > 8 * 1000000) { // 8 Mb max size
            window.alert('Veuillez utiliser des images de moins de 8Mo');
        } else {
            if(file && file['type'].split('/')[0] === 'image'){ // si le fichier est une image
                // Création du lecteur
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = readerEvent => {
                    const content = readerEvent.target.result;
                    document.querySelector('#ajoutFichier').style.backgroundImage = 'url('+ content +')';
                    document.querySelector('#ajoutFichier').style.backgroundSize = 'cover';
                    const b64WithPrefix = reader.result;
                    document.querySelector('#b64Image').value = b64WithPrefix.substring(b64WithPrefix.indexOf(',') + 1);
                }
            }
            else {
                window.alert("Veuillez choisir un fichier valide");
            }
        }
    }
    input.click();
}
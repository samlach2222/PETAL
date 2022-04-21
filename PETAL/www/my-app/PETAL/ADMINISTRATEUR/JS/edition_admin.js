function AjoutImageProfil() {
    var input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        // Récuparation de la réference du fichier
        const file = e.target.files[0];
        if(file && file['type'].split('/')[0] === 'image'){ // si le fichier est une image
            // Création du lecteur
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = readerEvent => {
                const content = readerEvent.target.result;
                document.querySelector('#ajoutImageProfil').style.backgroundImage = 'url('+ content +')';
                document.querySelector('#ajoutImageProfil').style.backgroundSize = 'cover';
                const b64WithPrefix = reader.result;
                document.querySelector('#b64Image').value = b64WithPrefix.substring(b64WithPrefix.indexOf(',') + 1);
            }
        }
        else {
            window.alert("Veuillez choisir un fichier valide");
        }
    }
    input.click();
}
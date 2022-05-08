function AjoutImage() {
    var input = document.createElement('input');
    input.type = 'file';
    
    document.querySelector('#ajoutFichier').value = null;
    document.querySelector('#ajoutFichier').style.backgroundSize = '50%';
    
    //Supprime l'ancien input file
    const ancienFichier = document.getElementById('fichier');
    if (ancienFichier) {
        ancienFichier.remove();
    }
    
    input.onchange = e => {
        // Récuparation de la réference du fichier
        const file = e.target.files[0];
        
      //  window.alert(file.name);
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = readerEvent => {
            const content = readerEvent.target.result;
            document.querySelector('#ajoutFichier').style.backgroundSize = '0%';

            let trimmedSize = ConvertirFileSize(file.size);
            const asciiFileName = file.name.replace(/[^\x20-\x7E]/g, '');  //Garde uniquement les caractères ASCII
            document.querySelector('#ajoutFichier').value = asciiFileName+'\n\n'+trimmedSize;            
            
            const pathPrefix = '/my-app/PETAL/Cours/';
            var nom = document.getElementById('nomMatiere').value;
        }
        
        input.style.display = 'none';
        input.setAttribute('name', 'fichier');
        input.id = 'fichier';
        document.getElementById('td-fichier').appendChild(input);
    }
    input.click();
}

function ConvertirFileSize(fileSize) {
    let sizeType = 0;
    let trimmedSize = fileSize;
    while (trimmedSize > 1024 && sizeType < 4) {
        trimmedSize /= 1024;
        sizeType++;
    }
    
    //Arrondi à 2 chiffres après la virgule
    let result = Math.round(trimmedSize * 100) / 100;
    
    //Ajoute l'unité de taille
    switch (sizeType) {
        case 0:
            result += ' o';
            break;
        case 1:
            result += ' Ko';
            break;
        case 2:
            result += ' Mo';
            break;
        case 3:
            result += ' Go';
            break;
        case 4:
            result += ' To';
            break;
    }
    
    //Remplace le séparateur décimal par une virgule
    result = result.replace('.',',');
    
    return result;
}
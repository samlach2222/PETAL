const listeCours = document.getElementById('liste-cours');
const tableauSujets = document.getElementById('tableau-sujets');

function AjouterSujet(idSujet, nomSujet, nomPrenom, nombreDeReponses, resolu, dark = true) {
    //Insère une nouvelle ligne
    let row = tableauSujets.insertRow(-1);
    
    //Ajoute la première colonne
    let rowColumn = row.insertCell(0);
    let a = document.createElement('a');
    a.textContent = nomSujet;
    a.href = 'discussion_forum.php?sujet='+idSujet;
    rowColumn.appendChild(a);
    
    //Ajoute la deuxième colonne
    rowColumn = row.insertCell(1);
    rowColumn.innerHTML = nomPrenom;
    
    //Ajoute la troisième colonne
    rowColumn = row.insertCell(2);
    rowColumn.innerHTML = nombreDeReponses;
    
    //Ajoute la quatrième colonne
    rowColumn = row.insertCell(3);
    let imgResolu = document.createElement('img');
    imgResolu.setAttribute('width', '40px');
    imgResolu.setAttribute('height', '40px');
    if (resolu) {
        if (dark) {
            imgResolu.setAttribute('src', '../../Ressources/Pictures/résolu.png')
        } else {
            imgResolu.setAttribute('src', '../../Ressources/Pictures/résolu_light.png')
        }
    } else {
        imgResolu.setAttribute('src', '../../Ressources/Pictures/non_résolu.png')
    }
    rowColumn.appendChild(imgResolu);
}

function AjouterMatiere(nomMatiere){
    //Crée la nouvelle entrée dans la liste de cours
    let liCours = document.createElement('li');
    let aCours = document.createElement('a');
    aCours.textContent = nomMatiere;
    aCours.href = '?matiere='+nomMatiere;
    liCours.appendChild(aCours);
    
    //Ajoute l'entrée à la liste de cours
    listeCours.appendChild(liCours);
}

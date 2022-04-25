const listeCours = document.getElementById('liste-cours');
const messages = document.getElementById('messages');

function AjouterMessage(nomPrenom, date, contenu, envoyeur) {
    //Crée la div principale
    let message = document.createElement('div');
    if (envoyeur) {
        message.classList.add('message-envoye');
    } else {
        message.classList.add('message-recu');
    }
    
    //Crée la div de l'en-tête
    let messageEntete = document.createElement('div');
    messageEntete.classList.add('message-entete');
    
    //Ajoute le nom à l'en-tête
    let spanNomPrenom = document.createElement('span');
    spanNomPrenom.classList.add('message-nom');
    spanNomPrenom.textContent = nomPrenom;
    messageEntete.appendChild(spanNomPrenom);
    
    //Ajoute la date à l'en-tête
    spanNomPrenom = document.createElement('span');
    spanNomPrenom.classList.add('message-date');
    spanNomPrenom.textContent = date;
    messageEntete.appendChild(spanNomPrenom);
    
    //Crée la div du contenu et ajoute le contenu
    let messageContenu = document.createElement('div');
    messageContenu.classList.add('message-contenu');
    messageContenu.textContent = contenu;
    
    //Combine les divs et ajoute le message
    message.appendChild(messageEntete);
    message.appendChild(messageContenu);
    messages.appendChild(message);
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

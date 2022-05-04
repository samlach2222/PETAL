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

function SetNumeroEtudiant(numeroEtudiant) {
    window.numeroEtudiant = numeroEtudiant;
}

function EnvoyerMessage() {
    //Récupère le contenu du textarea
    const textareaMessage = document.getElementById('envoyer-message-texte');
    let contenu = textareaMessage.value;

    //Envoie le message seulement si le contenu n'est pas vide
    if (contenu) {
        //Récupère le nom depuis le bandeau
        let nom = document.getElementById('top-bar-right').children[0].textContent;

        //Formate la date actuelle
        let date = formatDate(new Date());

        //Ajoute le message au DOM (partie client)
        AjouterMessage(nom, date, contenu, true);

        //Efface le contenu du textarea
        textareaMessage.value = null;

        //Scroll tout en bas de la page
        document.scrollingElement.scrollTop = document.scrollingElement.scrollHeight;

        //Ajoute le message à la BDD (partie serveur)
        $.post('../PHP/script_discussion_forum_envoyer.php', {
            num: window.numeroEtudiant,
            contenuMessage: contenu,
            idSujetForum: window.idSujet
        });
    }
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function formatDate(date) {
    return (
    [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
    ].join('-') +
    ' ' +
    [
        padTo2Digits(date.getHours()),
        padTo2Digits(date.getMinutes()),
        padTo2Digits(date.getSeconds()),
    ].join(':')
    );
}

function DemanderMessages() {
    $.post('../PHP/script_discussion_forum_recevoir.php', {
        num: window.numeroEtudiant,
        idSujetForum: window.idSujet
    },
    function RecupererMessages(htmlMessages) {
        document.getElementById('messages').outerHTML = htmlMessages;
        
        if (document.getElementById('messages').getAttribute("resolu") == "true") {
            location.reload();
        }
    });
}

document.addEventListener("DOMContentLoaded", function(){
    //Récupère l'id du sujet
    let fullGetString = window.location.search;
    let indexSujet = fullGetString.lastIndexOf("&sujet=");
    if (indexSujet == -1) {  //Si il n'y a pas "&sujet="
        indexSujet = fullGetString.indexOf("?sujet=");
    }
    indexSujet += 7;
    let maybeNumber = fullGetString.substr(indexSujet);
    let numberString = "";
    for (let i = 0; i < maybeNumber.length; i++) {
        let char = maybeNumber[i];
        if (!Number.isNaN(Number(char))) {
            numberString += char;
        } else {
            break;
        }
    }
    window.idSujet = Number(numberString);  //Variable globale

    setInterval(DemanderMessages, 2000);  //Délai de 2 secondes pour ne pas surcharger la BDD
});

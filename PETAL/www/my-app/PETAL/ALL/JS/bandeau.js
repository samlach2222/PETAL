var popupOuvert = false;
const popup = document.getElementById('popup');
const topBarHauteur = document.getElementById('top-bar').getBoundingClientRect().height;
var popupAnimation = null;

// On ne peut pas avoir la hauteur avec display none
popup.style.display = 'flex';
const popupHauteur = popup.getBoundingClientRect().height;
popup.style.display = 'none';

// Initialise la position du popup
var i = Math.round(topBarHauteur - popupHauteur) - 1;
popup.style.top = i+"px";

function Popup() {
    if (popupAnimation == null){
        if (popupOuvert) {
            popupAnimation = setInterval(cacherPopup);
        } else {
            popup.style.display = 'flex';  // Le popup doit être visible avant l'animation
            
            popupAnimation = setInterval(afficherPopup);
        }   
    }
}

function cacherPopup() {
    if (popup.getBoundingClientRect().bottom <= topBarHauteur) {
        popupAnimation = clearInterval(popupAnimation);
        
        popup.style.display = 'none';  // Le popup doit être caché après l'animation
        popupOuvert = false;
    } else {
        popup.style.top = i+"px";
        i-=3;
    }
}

function afficherPopup() {
    if (popup.getBoundingClientRect().top >= topBarHauteur) {
        popupAnimation = clearInterval(popupAnimation);
        
        popupOuvert = true;
    } else {
        popup.style.top = i+"px";
        i+=3;
    }
}

function Deconnexion() {
    location.replace('../../ALL/PHP/deconnexion.php');
}

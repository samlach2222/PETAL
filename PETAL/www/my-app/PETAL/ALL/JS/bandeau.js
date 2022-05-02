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

function ChangerTheme() {
    let cookieValue = getCookie("theme");
    if(cookieValue === ""){ // le cookie n'existe pas
        document.cookie = "theme=0"; // light theme
    }
    else { // le cookie existe
        if(cookieValue == 1){
            document.cookie = "theme=0"; // light theme
            let css = document.querySelector("link[rel='stylesheet']").getAttribute("href");
            let newcss = css.replace("dark", "light");
            document.querySelector("link[rel='stylesheet']").setAttribute("href", newcss)
        }
        else if(cookieValue == 0){
            document.cookie = "theme=1"; // dark theme
            let css = document.querySelector("link[rel='stylesheet']").getAttribute("href");
            let newcss = css.replace("light", "dark");
            document.querySelector("link[rel='stylesheet']").setAttribute("href", newcss)
        }
    }
}

document.addEventListener("DOMContentLoaded", function(){
    let cookieValue = getCookie("theme");
    if(cookieValue === ""){ // le cookie n'existe pas
        document.cookie = "theme=0"; // light theme
    }
    else { // le cookie existe
        if(cookieValue == 1){
            let css = document.querySelector("link[rel='stylesheet']").getAttribute("href");
            let newcss = css.replace("light", "dark");
            document.querySelector("link[rel='stylesheet']").setAttribute("href", newcss)
        }
        else if(cookieValue == 0){
            let css = document.querySelector("link[rel='stylesheet']").getAttribute("href");
            let newcss = css.replace("dark", "light");
            document.querySelector("link[rel='stylesheet']").setAttribute("href", newcss)
        }
    }
});

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function SupprimerMatieres() {
    let nameList = [];
    document.querySelectorAll('.input_matiere').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let name = elem.parentElement.querySelector('a').getAttribute("href");
            name = name.replace("%20", " "); // remplace
            name = name.replace("gestion_cours.php?matiere=", ""); // supprime le surplus
            nameList.push(name);
            elem.parentElement.remove();
        }
    });
    let jsonArray = JSON.stringify(nameList);
    //Requete POST via AJAX
    $.post('../PHP/script_gestion_matiere.php', {
        data: jsonArray
    });
}
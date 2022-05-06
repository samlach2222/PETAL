function SupprimerMatieres() {
    let nameList = [];
    document.querySelectorAll('.input_matiere').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            const aTable = elem.closest('.lien_matiere');
            let name = aTable.getAttribute("href");
            name = name.replace("%20", " "); // remplace
            name = name.replace("gestion_cours.php?matiere=", ""); // supprime le surplus
            nameList.push(name);
            aTable.remove();
        }
    });
    let jsonArray = JSON.stringify(nameList);
    //Requete POST via AJAX
    $.post('../PHP/script_gestion_matiere.php', {
        data: jsonArray
    });
}
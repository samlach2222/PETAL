function SupprimerQCM() {
    let idList = [];
    const curId = document.querySelector('#session').value;
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#idQCM').value;
            idList.push(id);
            elem.parentElement.remove();

        }
    });
    let jsonArray = JSON.stringify(idList);
    // Requete POST via AJAX
    $.post('../PHP/script_liste_qcm.php', {
        data: jsonArray
    });
}

function EditerQCM() {
    let idList = [];
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#idQCM').value;
            idList.push(id);
        }
    });

    if(idList.length === 1) {
        let id = idList[0];
        // Requete POST via AJAX
        console.log("qcm");
        window.location.replace("../HTML/edition_qcm.php?id="+id);
    }
    else {
        AlertError("Vous ne pouvez pas modifier plus d'un qcm");
    }
}
function VoirResultatQCM(id_QCM) {
    var idQ=id_QCM;
    console.log("resultat qcm");
    window.location.replace("../HTML/resultat_qcm.php?id="+idQ);
}
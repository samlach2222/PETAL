function SelectionnerTout(){
    let CB = document.querySelectorAll(".CB");

    //si tous sont déjà selectionnés
    let countSelected = 0;
    for (let i=0;i<CB.length;i++) {
        if(CB[i].checked){
            countSelected++;
        }
    }
    if(CB.length === countSelected){
        for (let i=0;i<CB.length;i++) {
            CB[i].checked = false;
        }
        // changer la valeur du bouton
        document.querySelector("#selectAll").value = "Sélectionner tout";
    }
    else {
        for (let i=0;i<CB.length;i++) {
            CB[i].checked = true;
        }
        // changer la valeur du bouton
        document.querySelector("#selectAll").value = "Déselectionner tout";
    }
}
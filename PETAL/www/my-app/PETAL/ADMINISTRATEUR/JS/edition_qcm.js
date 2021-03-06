var comp=parseInt(document.getElementById('nbQuestion').value);
var nbA=parseInt(document.getElementById('nbAjoutQuestionJs').value);

function AjoutImageQCM(num) {
    var idQ="";
    for (var i = 2; i < num.length; i++) {
        idQ=idQ+num[i];
    }
    
    //Suppression de l'ancienne image
    document.querySelector('#Image'+idQ).removeAttribute("src");
    document.querySelector('#Image'+idQ).removeAttribute("height");
    document.querySelector('#Image'+idQ).setAttribute("class", "imageHidden");
    document.querySelector('#Himage'+idQ).setAttribute("value", -1);
    
    var input = document.createElement('input');
    input.type = 'file';
    input.onchange = e => {
        // Récuparation de la réference du fichier
        const file = e.target.files[0];

        // Check size
        const fsize = file.size;
        if (fsize > 8 * 1000000) { // 8 Mb max size
            window.alert('Veuillez utiliser des images de moins de 8Mo');
        } else {
            if(file && file['type'].split('/')[0] === 'image'){ // si le fichier est une image
                // Création du lecteur
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = readerEvent => {
                    const content = readerEvent.target.result;
                    const b64WithPrefix = reader.result;
                    const b64=b64WithPrefix.substring(b64WithPrefix.indexOf(',') + 1);
                    document.querySelector('#Image'+idQ).setAttribute("src", "data:image;base64,"+b64);
                    document.querySelector('#Image'+idQ).setAttribute("height", "100px");
                    document.querySelector('#Image'+idQ).setAttribute("class", "imageQCM");
                    document.querySelector('#Himage'+idQ).setAttribute("value", b64);
                }
            }
            else {
                window.alert("Veuillez choisir un fichier valide");
            }
        }
    }
    input.click();
}

function ajoutQuestion() {
    comp++;
    nbA++;
    var question=document.createElement('div');
    question.setAttribute('class','question');
    question.setAttribute('id','q'+comp);

    var label1=document.createElement('label');
    label1.innerHTML="Question";
    question.appendChild(label1);

    var output=document.createElement('output');
    output.innerHTML=comp;
    output.setAttribute('id','out'+comp);
    question.appendChild(output);

    var label2=document.createElement('label');
    label2.innerHTML=" : ";
    question.appendChild(label2);

    var inputQ=document.createElement('input');
    inputQ.setAttribute('type','text');
    inputQ.setAttribute('name','intitule'+comp);
    inputQ.setAttribute('id','intitule'+comp);
    question.appendChild(inputQ);

    var button=document.createElement('input');
    button.setAttribute('type','button');
    button.setAttribute('value','Ajout Image');
    button.setAttribute('onclick','AjoutImageQCM(this.id)');
    button.setAttribute('class','BtAjoutImage');
    button.setAttribute('id','bt'+comp);
    button.innerHTML="Ajout image";
    question.appendChild(button);

    question.appendChild(document.createElement('br'));

    var img=document.createElement('img');
    img.setAttribute('src','');
    img.setAttribute('id','Image'+comp);
    img.setAttribute('class','imageHidden');
    question.appendChild(img); question.appendChild(document.createElement('br'));
    var inputH=document.createElement('input');
    inputH.setAttribute('value','-1');
    inputH.setAttribute('id','Himage'+comp);
    inputH.setAttribute('name','Himage'+comp);
    inputH.setAttribute('type','hidden');
    question.appendChild(inputH);

    var reponse=document.createElement('div');
    reponse.setAttribute('id','reponses'+comp);

    var iRbRepon1=document.createElement('input');
    iRbRepon1.setAttribute('type','radio');
    iRbRepon1.setAttribute('name','reponse'+comp);
    iRbRepon1.setAttribute('id','reponseRB'+comp+'a');
    iRbRepon1.setAttribute('onclick','reponse(1,'+comp+')');
    var iRepon1=document.createElement('input');
    iRepon1.setAttribute('type','text');
    iRepon1.setAttribute('name','reponse'+comp+'a');
    iRepon1.setAttribute('id','reponse'+comp+'a');
    reponse.appendChild(iRbRepon1);
    reponse.appendChild(iRepon1);
    reponse.appendChild(document.createElement('br'));

    var iRbRepon2=document.createElement('input');
    iRbRepon2.setAttribute('type','radio');
    iRbRepon2.setAttribute('name','reponse'+comp);
    iRbRepon2.setAttribute('id','reponseRB'+comp+'b');
    iRbRepon2.setAttribute('onclick','reponse(2,'+comp+')');
    var iRepon2=document.createElement('input');
    iRepon2.setAttribute('type','text');
    iRepon2.setAttribute('name','reponse'+comp+'b');
    iRepon2.setAttribute('id','reponse'+comp+'b');
    reponse.appendChild(iRbRepon2);
    reponse.appendChild(iRepon2);
    reponse.appendChild(document.createElement('br'));

    var iRbRepon3=document.createElement('input');
    iRbRepon3.setAttribute('type','radio');
    iRbRepon3.setAttribute('name','reponse'+comp);
    iRbRepon3.setAttribute('id','reponseRB'+comp+'c');
    iRbRepon3.setAttribute('onclick','reponse(3,'+comp+')');
    var iRepon3=document.createElement('input');
    iRepon3.setAttribute('type','text');
    iRepon3.setAttribute('name','reponse'+comp+'c');
    iRepon3.setAttribute('id','reponse'+comp+'c');
    reponse.appendChild(iRbRepon3);
    reponse.appendChild(iRepon3);
    reponse.appendChild(document.createElement('br'));

    question.appendChild(reponse);
    var reponseQ=document.createElement('input');
    reponseQ.setAttribute('type','hidden');
    reponseQ.setAttribute('name','reponseQ'+comp);
    reponseQ.setAttribute('id','reponseQ'+comp);
    question.appendChild(reponseQ);
    document.getElementById('questions').appendChild(question);
    document.getElementById('nbQuestion').setAttribute('value',comp);

    document.getElementById('nbAjoutQuestionJs').setAttribute('value',nbA);
    
    var boutonEnlever = document.getElementById('remove');
    if (!boutonEnlever) { // si il n'y a pas de bouton enlever question
        //<input type="button" name="add" value="+" id="add" onclick="ajoutQuestion()" class="SecondButton">
        boutonEnlever = document.createElement('input');
        boutonEnlever.setAttribute('type','button');
        boutonEnlever.setAttribute('name','remove');
        boutonEnlever.value = '-';
        boutonEnlever.id = 'remove';
        boutonEnlever.setAttribute('onclick','enleverDerniereQuestion()');
        boutonEnlever.className = 'SecondButton';
        
        document.getElementById('boutonBas').prepend(boutonEnlever);
    }
}
function reponse(numR,idQ) {
    document.getElementById('reponseQ'+idQ).setAttribute('value',numR);
}
function matiereSelect() {
    var listSelect=document.getElementById('matiere');
    var selected=listSelect.options[listSelect.selectedIndex].value;
    document.getElementById('matiereSelectionner').setAttribute('value',selected);
}
function enleverDerniereQuestion() {
    const divQuestions = document.getElementById('questions');
    divQuestions.removeChild(divQuestions.lastChild);
    nbA--;
    
    if (nbA == 0) {
        document.getElementById('remove').remove();
    }
}
<?php

    include_once('../../ALL/PHP/BDD.php');

    $num = $_SESSION['num'];
    $idQCM = $_GET['id'];

    $req2 = $pdo->prepare('SELECT nomQCM FROM qcm WHERE idQCM = :idQCM');
    $req2->execute(array('idQCM' => $idQCM));
    $nom = $req2->fetch();
    $nomQCM = $nom[0];


    $req3 = $pdo->prepare('SELECT * FROM Question WHERE idQCM = :idQCM');
    $req3->execute(array('idQCM' => $idQCM));
    $question = $req3->fetchAll();



//requête récupérant les bonnes reponses du QCM
    $req3 = $pdo->prepare('SELECT reponseALaQuestion FROM question WHERE idQCM = :idQCM');
    $req3->execute(array('idQCM' => $idQCM));
    $rep = $req3->fetchAll();

    $resultat = 0;

    for($i=1; $i<=count($question); $i++){
        if(isset($_POST["reponse".$i])){
            //update sur repondeDeEtudiant si une réponsea été choisi
            $req4 = $pdo->prepare('UPDATE reponsedeetudiant SET reponseChoisie = :rep WHERE num = :num AND idQuestion = :idQuestion');
            $req4->execute(array('rep' => $_POST["reponse".$i], 'num' => $num, 'idQuestion' => $question[$i-1][0]));

            //vérification de la réponse 
            //incrémentation du résultat si réponse bonne
            if($rep[$i-1][0]== $_POST["reponse".$i]){
                $resultat++;
            }
        }
        else {
            //update sur repondeDeEtudiant si pas de réponse choisi 
            $req5 = $pdo->prepare('UPDATE reponsedeetudiant SET reponseChoisie = :rep WHERE num = :num AND idQuestion = :idQuestion');
            $req5->execute(array('rep' => NULL, 'num' => $num, 'idQuestion' => $question[$i-1][0]));

        }
    }


    echo"
        <div>
            <a id='retour' href='../../ETUDIANT/HTML/accueil_etudiant.php'> Retour </a>
            <h1> ".$nomQCM." </h1>
            <output> ".$resultat." / ".count($question)." </output>
            <br/>

        </div>
        <br/>
    ";


    echo" 
    <br/>
    <br/>

    <form action='' method='post'>
    ";

    foreach($question as $row){
        echo"

        <div id=".$row[0].">
            <div id='intitule'>
                <span> Question ".$row[0]." : </span>
                <span> ".$row[1]." </span>
                <img src='data:image;base64,".base64_encode($row[2])."'> </img>
            </div>
            <br/>
                <span id='rep'> Reponse ".$row[0]." :</span>
                    <br/>                
                    <input type='radio' name=\"reponse".$row[0]."\" value='1'/> ".$row[4]." 
                    <br/>
                    <input type='radio' name=\"reponse".$row[0]."\" value='2'/> ".$row[5]." 
                    <br/>
                    <input type='radio' name=\"reponse".$row[0]."\" value='3'/> ".$row[6]." 
                    <br/>
        </div>
        ";
    }

    echo "
        <button type ='submit' id='valider'>
            Valider
        </button>
        </form>
    </div>
    <br/>
    <br/>";
?>
<?php 
	$req = $pdo->prepare('SELECT nomMatiere FROM EtuMatiere WHERE num = :num', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $req->execute(array('num' => $num));
    $matiere = $req->fetchAll();

    $req = $pdo->prepare('SELECT moyenne, nomMatiere FROM moyenneEtuMatiere WHERE num = :num', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $req->execute(array('num' => $num));
    $notes = $req->fetchAll();

    //fonction permettant de dire si la matière a été validé selon la moyenne
    function mention($note){
        if($note < 10)
            return "non validé";
        else
            return "validé";
    }


    echo"
	    <div id='tabNote'>
	            <ul> <li>Detail des Cours :</li></ul>
	            <table id='tableau'>
	                <tr id='en-tete'>
	                    <td>
	                        <p> Cours </p>
	                    </td>
	                    <td>
	                        <p>  Note </p>
	                    </td>
	                    <td>
	                        <p>  Mention </p>
	                    </td>
	                </tr>          
    ";

	for($i=0; $i<count($matiere); $i++){
		for($j=0; $j<count($notes); $j++){
			if($matiere[$i][0] == $notes[$j][1]){
				$moyenne[$i] = $notes[$j][0];
				$mention[$i] = mention($notes[$j][0]);
			}
			else{
				$moyenne[$i] = "/";
				$mention[$i] = "/";

			}
		
		}
		echo"
			<tr>
	                    <td>
	                        <output id='nameCours'> ".$matiere[$i][0]." </output>
	                    </td>
	                    <td>
	                        <output id='note'> ".$moyenne[$i]."</output>
	                    </td>
	                    <td>
	                        <output id='mention'> ".$mention[$i]." </output>
	                    </td>
	                </tr>
		";
	}


	echo"
			</table>

        </div>
	";
        
?>
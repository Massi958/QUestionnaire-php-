<!DOCTYPE html>
<html>
 <head>
  <title>Espace Membre</title>
  <link rel="stylesheet" href='../Bootstrap/css/style_op.css' type="text/css"/>

 </head>
<body>

<h1>Choisissez votre questionnaire</h1>

		<?php
		
			include 'cnx.php';
			// $sql=$cnx->prepare("SELECT questionnaire.idQuestionnaire as 'id', questionnaire.libelleQuestionnaire as 'libelle',qcmfait.point as 'score',qcmfait.dateFait as 'date', qcmfait.idEtudiant
			// from questionnaire,qcmfait
			// where questionnaire.idQuestionnaire=qcmfait.idquestionnaire");
			// $sql->execute();
			
			$sql=$cnx->prepare("SELECT questionnaire.idQuestionnaire as 'id', questionnaire.libelleQuestionnaire as 'libelle'
			from questionnaire");
		    $sql->execute();
			
			$ligne1=$sql->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($ligne1);
		    // die();
			$sql=$cnx->prepare("SELECT questionnaire.idQuestionnaire,questionnaire.libelleQuestionnaire, qcmfait.dernierscore,qcmfait.dateFait
			from questionnaire
			inner join qcmfait on questionnaire.idQuestionnaire = qcmfait.idQuestionnaire
			WHERE qcmfait.idEtudiant = ".$_GET['id']);
		    $sql->execute();
            
			//$ligne=$sql->fetchAll(PDO::FETCH_ASSOC);
           

			echo "<table>";
	            
				echo"<tr>";
					echo "<th> Quiz n° </th>";
					echo"<th> Nom du quiz </th>";
					echo "<th> Score </th>";
					echo "<th> Date du dernier quizz </th>";
					echo "<th> Choix </th>";
    				echo"</tr>";
				foreach($sql->fetchAll(PDO::FETCH_ASSOC)as $ligne){
                echo"<tr>";
					echo"<td>".$ligne['idQuestionnaire']."</td>";
					echo "<td>".$ligne['libelleQuestionnaire'].   "</td>";
					echo "<td>".$ligne['dernierscore']."</td>";
					echo "<td>".$ligne['dateFait']."</td>";
					//echo "<td><a href='qcm.php?numQcm=".$ligne['id'].">Choisir</a></td>";
				echo"</tr>";
			}
			echo "</table>";
		
		
		?>


 </body>
</html>





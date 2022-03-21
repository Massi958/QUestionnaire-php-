<!-- <?php
		
			include 'cnx.php';
		
			$sql=$cnx->prepare("SELECT questionnaire.idQuestionnaire,questionnaire.libelleQuestionnaire, qcmfait.dernierscore,qcmfait.dateFait
			from questionnaire
			inner join qcmfait on questionnaire.idQuestionnaire = qcmfait.idQuestionnaire
			WHERE qcmfait.idEtudiant = ".$_GET['id']);
		    $sql->execute();
			// $idlibelle=$sql->fetchAll(PDO::FETCH_ASSOC);



			// $sql=$cnx->prepare("SELECT qcmfait.point as 'score, qcmfait.dateFait as 'date', qcmfait.idEtudiant
			// from qcmfait
			// where idEtudiant='".$_GET['id']."'");
		    // $sql->execute();
			// $scoredate=$sql->fetchAll(PDO::FETCH_ASSOC);
           ?>
<html>
 <head>
  <title>Espace Membre</title>
  <link rel="stylesheet" href='../Bootstrap/css/style_op.css' type="text/css"/>

 </head>
<body>

<h1>Choisissez votre questionnaire</h1>
			
			<table>
	        
				<tr>
					<th> Quiz n° </th>
					<th> Nom du quiz </th>
					<th> Score </th>
					<th> Date du dernier quizz </th>
					<th> Choix </th>
    				</tr>
				

				
                <tr>
					<td> 
						<?php echo $idlibelle[0]['id'];?> 
					</td>
					<td> 
						<?php echo $idlibelle[0]['libelle'];?>
					</td>
					<td> 
						<?php echo $scoredate[0]['score']; ?>
					</td>
					<td> 
						<?php echo $scoredate[0]['date'];?> 
					</td>
					<td><a href="questionnaire.php">Choisir</a></td>
				</tr>
			
			</table>
 </body>
</html>



 -->
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
			
			// $sql=$cnx->prepare("SELECT questionnaire.idQuestionnaire as 'id', questionnaire.libelleQuestionnaire as 'libelle'
			// from questionnaire");
		    // $sql->execute();
			
			//$ligne1=$sql->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($ligne1);
		    // die();


			$sql=$cnx->prepare("SELECT questionnaire.idQuestionnaire,questionnaire.libelleQuestionnaire, qcmfait.dernierscore,qcmfait.dateFait
			from questionnaire
			inner join qcmfait on questionnaire.idQuestionnaire = qcmfait.idQuestionnaire
			WHERE qcmfait.idEtudiant = ".$_GET['id']);
		    $sql->execute();
            
			//$ligne=$sql->fetchAll(PDO::FETCH_ASSOC);
           

			$sql1=$cnx->prepare("select questionnaire.idQuestionnaire,questionnaire.libelleQuestionnaire
			from questionnaire
			where questionnaire.idQuestionnaire not in (
			
			
			SELECT qcmfait.idQuestionnaire
						from qcmfait
						
						WHERE qcmfait.idEtudiant =".$_GET['id'].")");
		    $sql1->execute();

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
					echo "<td><a href='questionnaire.php?idques=".$ligne['idQuestionnaire']."'>Choisir</a></td>";
					
					
				echo"</tr>";
			}
             
			foreach($sql1->fetchAll(PDO::FETCH_ASSOC)as $ligne){
                echo"<tr>";
					echo"<td>".$ligne['idQuestionnaire']."</td>";
					echo "<td>".$ligne['libelleQuestionnaire'].   "</td>";
					echo "<td>0</td>";
					echo "<td></td>";
					echo "<td><a href='questionnaire.php?idques=".$ligne['idQuestionnaire']."'>Choisir</a></td>";
					echo"</tr>";
			}
					
			echo "</table>";
		
		
		?>


 </body>
</html>





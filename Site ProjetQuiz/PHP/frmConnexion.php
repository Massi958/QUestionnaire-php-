<?php


if(isset($_GET['btnConnexion']))
{
	if($_GET['login']== null)
	{
		echo "Saisir un login";
	}
	else if($_GET['motdepasse']== null)
	{
	
		echo "Saisir un mot de passe";
	}
	else
	{
		include 'cnx.php';
		$sql=$cnx->prepare("select idEtudiant as 'id', statut from etudiants where login ='".$_GET['login']."' and motdepasse = '".$_GET['motdepasse']."'");
		$sql->execute();
    	$res = $sql->fetchAll(PDO::FETCH_ASSOC);
		// echo"$res";
        // var_dump($res);
		// die();
		
		// var_dump($id);
		// die();
		if(count($res)== 0)
		{
			echo "Attention l'identifiant ou/et le mot de passe sont incorrect";
		}
		else if($res[0]['statut']==0)
		{
			$id=$res[0]['id'];
			//eleve
			header('Location:accueilQuestionnaire.php?id='.$id.'');
		}
		else
		{
			//prof
			header('Location:nomdelapage');
	
		}



	}

	
	
}
?>
<!DOCTYPE HTML>
<html>
	<head>
    <script src="https://cdn.tailwindcss.com"></script>
		<title>Projet Quiz</title>
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<!-- appel feuille de style -->
		<link href="style_op.css" type="text/css" rel="stylesheet" media="all">
	</head>
	<body  >
		

<div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">

        <h3 class="text-2xl font-bold text-center">Connexion</h3>

        <form form method='GET' action='frmConnexion.php' name='connexion' enctype='application/x-www-form-urlencoded'>
            <div class="mt-4">
                <div>
                    <label class="block" for="email">Login <label>
                            <input type="text" name='login' placeholder=" votre login "
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Mot de passe<label>
                            <input name="motdepasse" type="password" placeholder="Votre mot de passe"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-baseline justify-between">
                    <input class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900" type='submit' value='Connexion' name='btnConnexion'>
                    <a href="frmMdpOublier.php" class="text-sm text-blue-600 hover:underline">Mot de passe oublié?</a>
                </div>
            </div>
        
    </div>
</div>


	</body>
</html>
<?php
$statut=0;

if(isset($_POST['inscri']))
{
	if($_POST['nom']== null)
	{
		echo "Saisir un nom";
	}
	else if($_POST['prenom']== null)
	{
	
		echo "Saisir un prenom";
	}else if($_POST['login']== null)
	{
	
		echo "Saisir un login";
	}else if($_POST['motdepasse']== null)
	{
	
		echo "Saisir un mot de passe";
	}else if($_POST['rmotdepasse']== null)
	{
	
		echo "Saisir une confirmation de mot de passe";
	}else if($_POST['email']== null)
	{
	
		echo "Saisir un email";
	}else if( $_POST['motdepasse']!= $_POST['rmotdepasse'])
	{
		echo "Attention les deux mot de passe sont différents";
	}

	else
	{
		include 'cnx.php';
		$sql=$cnx->prepare("
		INSERT INTO etudiants (email,login,motDepasse,nom,prenom,statut)
		VALUES ('".$_POST['email']."','".$_POST['login']."','".$_POST['motdepasse']."','".$_POST['nom']."','".$_POST['prenom']."','".$_POST['statut']."')");
		$sql->execute();
    	$res = $sql->fetchAll(PDO::FETCH_ASSOC);

		header('Location:frmConnexion.php');



	}

	
	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<script src="https://cdn.tailwindcss.com"></script>
		<title>Inscription espace personnel:</title>
		<meta NAME="Author" CONTENT="Thierry Blavin">
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<!-- appel feuille de style -->
		<link href="style_op.css" type="text/css" rel="stylesheet" media="all">
	</head>
	<body >
		
	<form method='POST' action='frmInscription.php' name='annuaire' enctype='application/x-www-form-urlencoded'>

		<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="px-8 py-6 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3">
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-blue-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-center"> S'inscrire </h3>
		
        
            <div class="mt-4">
                <div>
                    <label class="block" for="Name"> Nom<label>
                            <input type="text" placeholder="Votre nom" name='nom'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
				<div>
                    <label class="block" for="Name"> prenom <label>
                            <input type="text" placeholder="Votre prénom" name='prenom'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block" for="login">login<label>
                            <input type='text' name='login' placeholder='Votre login'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block"> mot de passe <label>
                            <input type='password' name='motdepasse'  placeholder='Saisir votre mot de passe'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Confirm Password<label>
                            <input type='password' name='rmotdepasse'  placeholder='Confirmer votre mot de passe'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

				<div class="mt-4">
                    <label class="block"> E-mail <label>
                            <input input type='text' name='email' size='20' placeholder='Votre adresse mail'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <!-- <span class="text-xs text-red-400">Password must be same!</span> -->
                <div class="flex">
                    <!-- <button class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"> S'inscrire</button> -->
					<input type='submit' name='inscri'value="S'inscrire" class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">
                </div>
                
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
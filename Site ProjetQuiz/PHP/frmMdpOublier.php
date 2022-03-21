<?php
    if(isset($_POST['btnModifier']))
    {
        if($_POST['email']== null)
        {
            echo "Saisir un email";
        }
        else if($_POST['nouveauMotdepasse']== null)
        {
        
            echo "Saisir votre nouveau mot de passe" ;
        }
		else if($_POST['confirmerMotdepasse']== null)
        {
        
            echo "Saisir la confirmation du nouveau mot de passe" ;
        }
        else
        {
			if( $_POST['nouveauMotdepasse']!= $_POST['confirmerMotdepasse'])
			{
				echo "Attention les deux mot de passe sont différents";
			}
			else
			{
				include 'cnx.php';

				$sql=$cnx->prepare("select email from etudiants where email = '".$_POST['email']."'");
				$sql->execute();
				$res = $sql->fetchAll(PDO::FETCH_ASSOC);
				if(count($res)!=0)
				{
				$sql=$cnx->prepare("UPDATE etudiants SET motDePasse='".$_POST['nouveauMotdepasse']."' WHERE email='".$_POST['email']."'");
				$sql->execute();
				// var_dump($row);
				// if($row == 0)
				// {
				// 	echo "Votre mot de passe n'à pas été modifié";
				// }
				// else
				// {
					echo "Votre mot de passe à bien été modifié";
				}
				else
				{
					echo "Votre mot de passe n'à pas été modifié";
				}
				


			}
            



        }

        
        
    }
?>

<!DOCTYPE HTML>
<html>

	<head>

	<script src="https://cdn.tailwindcss.com"></script>
		<title>Modifier le mot de passe</title>
		<meta NAME="Author" CONTENT="Thierry Blavin">
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<!-- appel feuille de style -->
		<link href="style_op.css" type="text/css" rel="stylesheet" media="all">
	</head>

	<body>
		
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
        <h3 class="text-2xl font-bold text-center"> Modifier le mot de passe </h3>
		 
		<form form method='POST' action='frmMdpOublier.php' name='annuaire1' enctype='application/x-www-form-urlencoded'>
        
            <div class="mt-4">
                
                <div class="mt-4">
                    <label class="block" for="login">Email <label>
                            <input  type='text' name='email' placeholder='Votre email'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block"> Nouveau mot de passe <label>
                            <input input type='password' name='nouveauMotdepasse' size='40' placeholder='Votre mot de passe'
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Confirmer votre nouveau mot de passe<label>
                            <input type='password' name='confirmerMotdepasse' size='40' placeholder='Confirmer votre mot de passe'

                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>


                
                <div class="flex">
                    <button class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"> Modifier </button>
                </div>
                
            </div>
        
    </div>
</div>
</div>
	</body>
</html>
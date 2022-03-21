<?php
// page de controle de saisie, et appel de fonction d'insertion dans la base

// recuperation des variables du formulaire de annuaire1.php par le tableau associatif $_POST
$loginco=$_POST["login"];
$motdepasseco=$_POST["motdepasse"];
// Vérification des champs nom et prenom (si il ne sont pas vides ?)
if( empty($loginco) || empty($motdepasseco) )  // le signe || signifie OU
{
	$message_erreur="ATTENTION : Le champ login ou motdepasse n'a pas été rempli correctement, veuillez vérifier";
	// redirection vers la page vue erreur
	header("Location: vue_erreur_membres.php?erreur=$message_erreur");
	exit(); // interruption après redirection
	
}
else // $nom et $prenom sont corrects  
{
	include 'fonctions_insertion.php'; // fichier externe contenant les fonctions d'accès à la base de données

	$nb_lignes=verify_membres($loginco, $motdepasseco); // appel de fonction d'insertion (couche Modele)

	if($nb_lignes > 0) // on a inséré 1 ligne
	{
		//recupération $id
		$idmembre=recup_idmembre($loginco, $motdepasseco); // appel de fonction d'insertion (couche Modele)
		//redirection vers la page connexion
		header("Location: accueilQuestionnaire.php?id=$idmembre[0]"); // page de confirmation
		exit(); // interruption de la fonction après redirection
	}
	else // il y a eu une erreur
	{
		$message_erreur="Vous n'avez pas été authentifier de vérifier que votre login ou motdepasse soit correct";
		// redirection vers la page vue erreur
		header("Location: vue_erreur_membres.php?erreur=$message_erreur");
	}		
	
	
} // fin si empty nom


?>

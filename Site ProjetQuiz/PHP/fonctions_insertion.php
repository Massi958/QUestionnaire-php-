<?php

function verify_membres($loginco, $motdepasseco) // fonction qui renvoie un tableau de tous les adherents
{
   require 'param_connexion.php'; // pour connexion au SGBD
   
   $requete="select * from membres where login='$loginco' AND motdepasse='$motdepasseco'";
   $resultat_sql = mysqli_query($lien_base, "$requete");
   if($resultat_sql == false) // si impossible d'exécuter la requête SELECT
   {	
	   die("Impossible de vous connecter" . mysqli_error());
   }
   else // SELECT réussi
   {
	   $nb_lignes=mysqli_affected_rows($lien_base); // compte le nombre de lignes du SELECT
   }

   return $nb_lignes;
}// fin fonction()

?>
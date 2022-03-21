<?php
$numeroQuestionnaire=$_GET['idques'];
session_start();
    include 'cnx.php';

    if(isset($_GET['btnSuivant']))
    {
        // SVG la reponse à la question
        //$_SESSION['reponseQst']= ;
        // Tu passes à la question suivante
        
        print_r($_SESSION['nbQuest']);
        print_r($_SESSION['nbQstTotal']);

        if($_SESSION['nbQuest'] < $_SESSION['nbQstTotal'])

        {
 
        $sql2=$cnx->prepare("SELECT question.idQuestion, question.libelleQuestion FROM question, questionquestionnaire where question.idQuestion = questionquestionnaire.idQuestion 
        and questionquestionnaire.idQuestion = ".$_SESSION['tabIdQuestions'][$_SESSION['nbQuest']]);
       $sql2->execute();
       $question = $sql2->fetchAll(PDO::FETCH_ASSOC);
        
       $_SESSION['nbQuest'] = $_SESSION['nbQuest'] + 1 ;

      
       
       $sql3=$cnx->prepare("SELECT questionreponse.idQuestion,questionreponse.idReponse,reponse.valeur
       from questionreponse,reponse
       where questionreponse.idReponse=reponse.idReponse and questionreponse.idQuestion= ".$_GET['idques'] );
       $sql3->execute();
       echo  "<h1>".$question[0]['libelleQuestion']."</h1>";
       echo "<form method= 'GET' action='questionnaire.php?idques=2'>";
       
       foreach($sql3->fetchAll(PDO::FETCH_ASSOC)as $ligne1){
           // var_dump($ligne1);
           // die();
          
           echo "<input type='radio' name='q1'>";
           echo "<label>".$ligne1['valeur']."<label>";
           echo "<br>";
           
       }
       
       echo "<input type='submit' value='Submit'>";
       echo "</form>";
        }
        else
        {
            echo "fin";
        }

    }
    else if ($_SESSION['nbQuest'] =1)
    {
        $sql=$cnx->prepare("SELECT count(idQuestion) from questionquestionnaire where idQuestionnaire =".$_SESSION['nbQuest']);
        $sql->execute();
        $res1 = $sql->fetchAll(PDO::FETCH_ASSOC);
        $count = $res1[0]['count(idQuestion)'];

    
        // $sql2=$cnx->prepare("SELECT question.idQuestion, question.libelleQuestion FROM question, questionquestionnaire where question.idQuestion = questionquestionnaire.idQuestion 
        // and questionquestionnaire.idQuestionnaire = ".$_GET['idques']);
        // $sql2->execute();
        // $res2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
        // $libelle=$res2[0]['libelleQuestion'];

        $sql2=$cnx->prepare("SELECT questionquestionnaire.idQuestion FROM  questionquestionnaire where questionquestionnaire.idQuestionnaire = ".$numeroQuestionnaire);
        $sql2->execute();

        $tabIdQuestions = array();
        $i = 0;
        foreach($sql2->fetchAll(PDO::FETCH_ASSOC)as $ligne)
        {
            $tabIdQuestions[$i] = $ligne['idQuestion'];
            $i++;
        }
        
        $_SESSION['tabIdQuestions'] = $tabIdQuestions;


        // SVG le nombre de Questions
        //$_SESSION['lblQst'] = $libelle;
        // SVG les id des questions
        $_SESSION['nbQstTotal']= $count ;

        $_SESSION['nbQuest'] = 1 ;


        // On va cherher la première question
        $sql2=$cnx->prepare("SELECT question.idQuestion, question.libelleQuestion FROM question, questionquestionnaire where question.idQuestion = questionquestionnaire.idQuestion 
         and questionquestionnaire.idQuestion = ".$_SESSION['tabIdQuestions'][0]);
        $sql2->execute();
        // $question = $sql2->fetchAll(PDO::FETCH_ASSOC);
        foreach($sql2->fetchAll(PDO::FETCH_ASSOC)as $ligne1){
            // var_dump($ligne1);
            // die();
            echo  $ligne1['libelleQuestion'] ; 

            
           
        }
        $sql3=$cnx->prepare("SELECT questionreponse.idQuestion,questionreponse.idReponse,reponse.valeur
       from questionreponse,reponse
       where questionreponse.idReponse=reponse.idReponse and questionreponse.idQuestion= ".$_GET['idques'] );
       $sql3->execute();
        
        echo "<form method= 'GET' action='questionnaire.php?idques=2'>";
       foreach($sql3->fetchAll(PDO::FETCH_ASSOC)as $ligne1){
           // var_dump($ligne1);
           // die();
          
           echo "<input type='radio' name='q1'>";
           echo "<label>".$ligne1['valeur']."<label>";
           echo "<br>";
           
       }
       
       echo "<input type='submit' value='Submit'>";
       echo "</form>";
       

        // $sql3=$cnx->prepare("SELECT questionreponse.idQuestion,questionreponse.idReponse,reponse.valeur
        // from questionreponse,reponse
        // where questionreponse.idReponse=reponse.idReponse and questionreponse.idQuestion= ".$_GET['idques'] );
        // $sql3->execute();
        // echo  "<h1>".$question[0]['libelleQuestion']."</h1>";
        // echo "<form method= 'GET' action='questionnaire.php?idques=2'>";
        
        // foreach($sql3->fetchAll(PDO::FETCH_ASSOC)as $ligne1){
        //     // var_dump($ligne1);
        //     // die();
           
        //     echo "<input type='radio' name='q1'>";
        //     echo "<label>".$ligne1['valeur']."<label>";
        //     echo "<br>";
            
        // }
        
        // echo "<input type='submit' value='Submit'>";
        // echo "</form>";
        
    }
    $_SESSION['nbQuest'] = $_SESSION['nbQuest'] + 1 ;
    // $sql2=$cnx->prepare("SELECT questionquestionnaire.idQuestionnaire,questionreponse.idReponse,reponse.valeur FROM questionreponse, questionquestionnaire,reponse WHERE questionreponse.idQuestion = questionquestionnaire.idQuestion and questionreponse.idReponse = reponse.idReponse 
    // and questionreponse.idQuestion=1;");
	// $sql1->execute();
	// $res = $sql1->fetchAll(PDO::FETCH_ASSOC);
    // $reponse=$res[0][''];






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire</title>
    <link rel="stylesheet" href="../Bootstrap/css/style_op.css">
</head>
<body>
    <!-- <form method= "GET" action="questionnaire.php?idques=2">
       
        
            <input type="submit" value="Submit">
                     <input type="submit" value="Next" name="btnSuivant"> 
    </form> -->
</body>
</html>
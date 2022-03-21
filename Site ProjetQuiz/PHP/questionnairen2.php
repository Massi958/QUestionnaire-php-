<?php
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
        }
        else
        {
            echo "fin";
        }

    }
    else
    {
        $sql=$cnx->prepare("SELECT count(idQuestion) from questionquestionnaire where idQuestionnaire =".$_GET['idques']);
        $sql->execute();
        $res1 = $sql->fetchAll(PDO::FETCH_ASSOC);
        $count = $res1[0]['count(idQuestion)'];

    
        // $sql2=$cnx->prepare("SELECT question.idQuestion, question.libelleQuestion FROM question, questionquestionnaire where question.idQuestion = questionquestionnaire.idQuestion 
        // and questionquestionnaire.idQuestionnaire = ".$_GET['idques']);
        // $sql2->execute();
        // $res2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
        // $libelle=$res2[0]['libelleQuestion'];

        $sql2=$cnx->prepare("SELECT questionquestionnaire.idQuestion FROM  questionquestionnaire where questionquestionnaire.idQuestionnaire = ".$_GET['idques']);
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



        $question = $sql2->fetchAll(PDO::FETCH_ASSOC);

       

    }
   
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
    <form method= "GET" action="questionnaire.php">
        <h1> <?php echo  $question[0]['libelleQuestion'] ;?> </h1>
        <!-- <p>
            <strong><?php ?></strong>
            <br>
            <input type="radio" name="q1" value="">
                <label>
                   
                </label></br>
            <input type="submit" name="btnSuivant" value="Suivant">
        </p> -->
        <input type="submit" value="Next" name="btnSuivant">
    </form>
</body>
</html>
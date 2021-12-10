<!-- Ce formulaire contient les informations suivantes : titre, description, date de
début, date de fin. -->

<?php

session_start();


$connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');

$login = $_SESSION['login'];  
        

if(!empty($_POST)){
    extract($_POST);
    $validation=true;
  }

if(isset($_POST['reserver'])){

    $titre=$_POST['titre'];
    $description=$_POST['description'];
    $type=$_POST['type'];

    //Pour transformer le mode d'input - format de date vers celui de sqli afin de permettre plus tard la comparaison entre les deux
        $debut=$_POST['debutdate'];
        $time = strtotime($debut);
    $newformatDebut = date("Y-m-d H:i:s",$time);
    // Pour empêcher de s'inscrire le samedi et le dimanche 
    $jourDebut = date('D',$time);
    //pour empêcher de s'inscrire plus d'un jour
    $jDebut = date('d',$time);
    // pour vérifier l'heure par la suite - ne pas dépasser les 1h
    $heureExt = explode(' ', $newformatDebut); 
    $heureDebut = end($heureExt); 


        $fin=$_POST['findate'];
        $time1 = strtotime($fin);
    $newformatFin = date("Y-m-d H:i:s",$time1);
    $jourFin = date('D',$time1);
    $jFin = date('d',$time1);
    $heureExt1 = explode(' ', $newformatFin); 
    $heureFin = end($heureExt1);
 

    // on va d'abord vérifier les erreurs possibles : champs vides, créneaux déjà réservés, plus d'une heure, plus d'un jour, jour de fin antérieur au jour de fin == validation false
    // si pas d'erreur alors tu me prends l'id de la session ET tu me rentres sa réservation


    if(empty($titre)){
        $validation = false;
        $titreVide = "Veuillez rentrer un titre.";
        echo $titreVide;     
    }
    if(empty($description)){
        $validation = false;
        $descriptionVide = "Veuillez rentrer une description.";
        echo $descriptionVide;     
    }

    // //pour récupérer les dates afin de vérifier s'il y a disponibilité
    $dateVerif=mysqli_query($connect, "SELECT `debut`, `fin` FROM `reservations`");
    $dateFetch=mysqli_fetch_all($dateVerif, MYSQLI_ASSOC);

    foreach($dateFetch as $date){

        if($date['debut']==$newformatDebut && $date['fin']==$newformatFin){
               $validation = false;
               $verifErr = "Le créneaux est indisponible, veuillez-vous référer au planning et choisir un autre créneaux.";
               echo $verifErr;      
        }
    }
        if($newformatFin < $newformatDebut){
            $validation = false;
            $timeErr = "La date de fin est antérieure à la date de début, on ne peut remonter dans le temps !";
            echo $timeErr;
        }elseif (($jourDebut == "Sat" || $jourDebut == "Sun") || ($jourFin == "Sat" || $jourFin == "Sun")){
            $validation=false;
            $weekendErr = "Vous ne pouvez réserver la salle le week-end.";
            echo $weekendErr;
        }elseif($jFin-$jDebut>=1){
            $validation=false;
            $jourErr = "Vous ne pouvez réserver la salle que pour une heure le même jour.";
            echo $jourErr;
        }

        if($heureFin - $heureDebut >"1:00"){
            $validation = false;
            $heureErr = "Vous ne pouvez réserver la salle plus d'une heure.";
            echo $heureErr;
        }

    if ($validation){

        $requestId = mysqli_query($connect, "SELECT `id` FROM `utilisateurs` WHERE `login`='".$login."'");
        $recupId = mysqli_fetch_assoc($requestId);
        foreach ($recupId as $id){
            $queryInsert=mysqli_query($connect, "INSERT INTO `reservations`(`titre`, `description`, `debut`, `fin`, `id_utilisateur`, `type_activité`) VALUES ('$titre','$description','$debut','$fin', '$id' ,'$type')");
        }  
    }
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Réservation form || UC</title>
</head>
<body>
<header>
        <?php 
        if(!isset($login)){ ?>

        <section class="navbar">
            <a href="inscription.php"><p>Sign in</p></a>
            <a href="connexion.php"><p>Log in</p></a>
            <a href="planning.php"><p>Planning</p></a>
        </section>
        <?php
        }else { ?>
        <section class="navbar">
            <a id="rose" href="index.php"><p>Index</p></a>
            <a id="bleu" href="profil.php"><p>Mon profil</p></a> 
            <a id="jaune" href="planning.php"><p>Planning</p></a> 
            <form action="deconnexion.php" method="post">
                <button class="boutondeco" type="submit" name="deco">Deconnexion</button>
            </form>
        </section>
        <?php
        }
        
        ?>
    </header>

    <form action="reservation-form.php" method="post">

            <label for="activités">Type d'activité:</label>
            <select id="activites" name="type">
                <option value="loisirs">Loisirs</option>
                <option value="scolaire">Scolaire</option>
                <option value="social">Social</option>
                <option value="festivite">Festivités</option>
            </select>

            <label for="name">Titre: </label>
            <input type="text" name="titre" id="titre">

            <label for="name">Description: </label>
            <textarea name="description" id="description"></textarea>

            <label for="name">Date de début: </label>
            <input type="datetime-local" name="debutdate" id="debutdate" required>

            <label for="name">Date de fin: </label>
            <input type="datetime-local" name="findate" id="findate" required>


        <button type="submit" name="reserver">Réserver</button>

    </form>
</body>
</html>
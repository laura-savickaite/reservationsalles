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

        if(@$heureFin - @$heureDebut > "1:00"){
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
    <title>Réservation form || BookWithMe</title>
</head>
<body>
<header>
        <section class="navbar">
            <a id="rose" href="index.php"><p>Index</p></a>
            <a id="bleu" href="profil.php"><p>Mon profil</p></a> 
            <a id="jaune" href="planning.php"><p>Planning</p></a> 
            <form action="deconnexion.php" method="post">
                <button class="boutondeco" type="submit" name="deco">Deconnexion</button>
            </form>
        </section>

    </header>
    <main>
        <article id="reservation">
            <section>
                <form action="reservation-form.php" method="post" name="type">
                    <div id="saveslot">
                        <div class="label">
                            <label for="activités">Type d'activité:</label>
                            <select id="activites" name="type">
                                <option value="scolaire">Scolaire</option>
                                <option value="loisirs">Loisirs</option>
                                <option value="sport">Sport</option>
                                <option value="social">Social</option>
                                <option value="loisirs">Loisirs</option>
                                <option value="festivite">Festivités</option>
                            </select>
                        </div>
                        <div class="label">
                            <label for="name">Titre: </label>
                            <input type="text" name="titre" id="titre">
                        </div>
                        <div class="label">
                            <label for="name">Description: </label>
                            <textarea name="description" id="description"></textarea>
                        </div>
                        <div class="label">
                            <label for="name">Date de début: </label>
                            <input type="datetime-local" name="debutdate" id="debutdate" required>
                        </div>
                        <div class="label">
                            <label for="name">Date de fin: </label>
                            <input type="datetime-local" name="findate" id="findate" required>
                        </div>
                
                    </div> 
                    <div id="save">
                        <button type="submit" name="reserver">Réserver</button>
                    </div>
                </form>
        </section>

        <section id="explications">
        <div id="explitxt">
            <ul class="fadeIn">
                <li>Avant de réserver, veuillez vérifier le planning.</li>
                <li>Faites attention aux dates, la date de fin ne doit pas être antérieure à celle du début.</li>
                <li>Vous ne pouvez réserver qu'une heure par séance.</li>
                <li>Les séances sont des heures rondes (ex: 8:00, 9:00 etc...) même si vous réservez à la demie. </li>
            </ul>
        </div>
        </section>
    </article>
    </main>
</body>
</html>
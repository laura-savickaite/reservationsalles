<!-- Ce formulaire contient les informations suivantes : titre, description, date de
début, date de fin. -->

<?php

session_start();

$connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');

$login = $_SESSION['login']; 

if(isset($_POST['reserver'])){


    $titre=$_POST['titre'];
    $description=$_POST['description'];
    $debut=$_POST['debutdate'];
    $fin=$_POST['findate'];
    
    $titre=htmlentities($titre);
    $description=htmlentities($description);
    // $confpassword=htmlentities(trim($confpassword));

    $requestId = mysqli_query($connect, "SELECT `id` FROM `utilisateurs` WHERE `login`='".$login."'");
    $recupId = mysqli_fetch_assoc($requestId);

    var_dump($recupId);

    // d'abord on prend l'id de la session ensuite on va faire les erreurs possibles et si pas d'erreurs alors on rentre dans le tableau MAIS SI DEJA QQCHOSE DE RENTRE alors on met une erreur --- if pas de truc déjà alors tu rentres else tu fais une erreur


    if(empty($titre)){

    }

    // à réfléchir au fait que si déjà pris ce créneaux on lui dit

    // $requestverif=mysqli_query($connect, "SELECT `debut`, `fin` FROM `reservations` WHERE `debut` = '".$_POST['debutdate']."'");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation form || UC</title>
</head>
<body>
    <form action="inscription.php" method="post">

            <label for="name">Titre: </label>
            <input type="text" name="titre" id="titre">

            <label for="name">Description: </label>
            <textarea name="description" id="description"></textarea>

            <label for="name">Date de début: </label>
            <input type="date" name="debutdate" id="debutdate">

            <label for="name">Date de fin: </label>
            <input type="date" name="findate" id="findate">

            <!-- <label for="name">Horaire: </label>
            <input type="time" name="heure" id="heure" min="08:00" max="19:00"> -->


        <button type="submit" name="reserver">Réserver</button>

    </form>
</body>
</html>
<!-- Cette page affiche le nom du créateur, le titre de l’événement, la
description, l’heure de début et de fin. Pour savoir quel évènement afficher,
vous devez récupérer l’id de l’événement en utilisant la méthode get. (ex :
http://localhost/reservationsalles/evenement/?id=1) Seuls les personnes
connectées peuvent accéder aux événements. -->

<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'reservationsalles');
mysqli_set_charset($connect,"utf8");

if(!isset($_SESSION['login'])){
    header('Location:index.php');
}else {


    $queryReservation = mysqli_query($connect, "SELECT utilisateurs.login, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité, reservations.description  FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id WHERE reservations.id = '".$_GET['val']."'");
    $fetchReservation = mysqli_fetch_assoc($queryReservation);
    var_dump($fetchReservation);
    echo $fetchReservation['titre'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Réservation || UC</title>
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
            <a id="violet" href="planning.php"><p>Planning</p></a>
            <a id="jaune" href="reservation-form.php"><p>Add an event</p></a> 
            <form action="deconnexion.php" method="post">
                <button class="boutondeco" type="submit" name="deco">Deconnexion</button>
            </form>
        </section>
        <?php
        }
        
        ?>
    </header>
    <main>

    </main>
    <footer>
        
    </footer>
</body>
</html>
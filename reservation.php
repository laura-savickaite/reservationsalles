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

    
}

?>
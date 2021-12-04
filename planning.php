<!-- Sur cette page on voit le planning de la semaine avec l’ensemble des
réservations effectuées. Le planning se présente sous la forme d’un
tableau avec les jours de la semaine en cours. Dans ce tableau, il y a en
colonne les jours et les horaires en ligne. Sur chaque réservation, il est
écrit le nom de la personne ayant réservé la salle ainsi que le titre. Si un
utilisateur clique sur une réservation, il est amené sur une page dédiée.

Les réservations se font du lundi au vendredi et de 8h à 19h. Les créneaux
ont une durée fixe d’une heure. -->


<!--
    pour changer l'affichage de l'heure
    
$debutdateformat=mysqli_request($connect, "SELECT DATE_FORMAT(debut, '%d/%m/%Y') FROM reservations");
 $findateformat=mysqli_request($connect, "SELECT DATE_FORMAT(fin, '%d/%m/%Y') FROM reservations"); -->

 <?php

$connect = mysqli_connect('localhost', 'root', '', 'reservationsalles');

mysqli_set_charset($connect,"utf8");

$queryPlanning = mysqli_query($connect, "SELECT utilisateurs.login, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité  FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id");
$fetchPlanning = mysqli_fetch_all($queryPlanning, MYSQLI_ASSOC);

// var_dump($fetchPlanning);

foreach ($fetchPlanning as $value){
    // var_dump($value);
    // echo($value['debut']);
    $dateDebut=$value['debut'];
        $timeDebut = strtotime($dateDebut);
    $newdateDebut = date('g:i D j F Y',$timeDebut);
    echo $newdateDebut .'</br>';

    // echo date_format($dateDebut, 'g:ia \o\n l jS F Y');
    // echo "<td>". $value ['login'] ."</td>";
    
}

// il faut que je fasse qu'il sache quelle semaine on est 
// et place les friday dans les vendredi etc...







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Planning || UC</title>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>            </th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
        </tr>
    </thead>
    <tbody>
        <tr>   
            <td>
                8:00
            </td>     
        </tr>

        <tr>   
            <td>
                9:00
            </td>     
        </tr>

        <tr>   
            <td>
                10:00
            </td>     
        </tr>

        <tr>   
            <td>
                11:00
            </td>     
        </tr>

        <tr>   
            <td>
                12:00
            </td>     
        </tr>

        <tr>   
            <td>
                13:00
            </td>     
        </tr>

        <tr>   
            <td>
                14:00
            </td>     
        </tr>

        <tr>   
            <td>
                15:00
            </td>     
        </tr>

        <tr>   
            <td>
                16:00
            </td>     
        </tr>

        <tr>   
            <td>
                17:00
            </td>     
        </tr>

        <tr>   
            <td>
                18:00
            </td>     
        </tr>

        <tr>   
            <td>
                19:00
            </td>     
        </tr>
    </tbody>
</table>

</body>
</html>


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
                8h
            </td>     
        </tr>

        <tr>   
            <td>
                9h
            </td>     
        </tr>

        <tr>   
            <td>
                10h
            </td>     
        </tr>

        <tr>   
            <td>
                11h
            </td>     
        </tr>

        <tr>   
            <td>
                12h
            </td>     
        </tr>

        <tr>   
            <td>
                13h
            </td>     
        </tr>

        <tr>   
            <td>
                14h
            </td>     
        </tr>

        <tr>   
            <td>
                15h
            </td>     
        </tr>

        <tr>   
            <td>
                16h
            </td>     
        </tr>

        <tr>   
            <td>
                17h
            </td>     
        </tr>

        <tr>   
            <td>
                18h
            </td>     
        </tr>

        <tr>   
            <td>
                19h
            </td>     
        </tr>
    </tbody>
</table>

</body>
</html>
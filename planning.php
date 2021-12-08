<!-- Sur cette page on voit le planning de la semaine avec l’ensemble des
réservations effectuées. Le planning se présente sous la forme d’un
tableau avec les jours de la semaine en cours. Dans ce tableau, il y a en
colonne les jours et les horaires en ligne. Sur chaque réservation, il est
écrit le nom de la personne ayant réservé la salle ainsi que le titre. Si un
utilisateur clique sur une réservation, il est amené sur une page dédiée.

Les réservations se font du lundi au vendredi et de 8h à 19h. Les créneaux
ont une durée fixe d’une heure. -->

 <?php

$connect = mysqli_connect('localhost', 'root', '', 'reservationsalles');

mysqli_set_charset($connect,"utf8");

$queryPlanning = mysqli_query($connect, "SELECT utilisateurs.login, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité  FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id");
$fetchPlanning = mysqli_fetch_all($queryPlanning, MYSQLI_ASSOC);


//date("Y-m-d", strtotime("-1 week")) retourne la date d'il y a une semaine 
//Si tu veux récupérer la semaine suivante, tu incrémente simplement la valeur du paramètre week de 1 dans ta fonction.
//Regarde la doc de strtotime, il y a un second paramètre facultatif pour indiquer la date de référence :
// int strtotime ( string $time [, int $now = time() ] )
// Par défaut, si tu ne le renseigne pas, il correspondra à la date du jour.Il faut le renseigner avec le timestamp de la semaine que tu veux récupérer.
// $query="SELECT * FROM table";
// $result=mysql_query($query)or die (mysql_error());
// $row=mysql_fetch_assoc($result)or die (mysql_error());
// $date=$row["DateTime"];// DateTimes est le nom du champs qui stocke les dates
// $DATE=$date("Y-m-d", strtotime("-1 day")) ;


// $today=time();
// $nextJour = time() + (24 * 60 * 60);
//                    // 24 hours; 60 mins; 60 secs
// echo 'Auj:       '. date('l d-m-y') ."\n";
// echo 'Demain: '. date('l d-m-y', $nextJour) ."\n";
$monday = date('l d-m-y', strtotime('monday this week'));
$tuesday = date('l d-m-y', strtotime('tuesday this week'));
$wednesday = date('l d-m-y', strtotime('wednesday this week'));
$thursday = date('l d-m-y', strtotime('thursday this week'));
$friday = date('l d-m-y', strtotime('friday this week'));

$eight = "8:00";
$nine = "9:00";
$ten = "10:00";
$eleven = "11:00";
$twelve = "12:00";
$thirteen = "13:00";
$fourteen = "14:00";
$fifteen = "15:00";
$sixteen = "16:00";
$seventeen = "17:00";
$eighteen = "18:00";
$nineteen = "19:00"; 


// cette fonction est utilisée plus tard
function creneaux ($jour,$heureDeb,$heureFinale){
    $connect = mysqli_connect('localhost', 'root', '', 'reservationsalles');

    $queryPlanning = mysqli_query($connect, "SELECT utilisateurs.login, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité, reservations.id FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id");
    $fetchPlanning = mysqli_fetch_all($queryPlanning, MYSQLI_ASSOC);
    
    foreach ($fetchPlanning as $value){
    $debut = $value['debut'];
    $fin = $value['fin'];
     
        // echo $debut;
        $time = strtotime($debut);
        $time1 = strtotime($fin);
        $jourDebut = date("l d-m-y",$time);
        $heureDebut = date("H:i",$time);
        $heureFin = date("H:i",$time);

        // echo $newformatDebut;

    if($jourDebut == $jour && ($heureDebut >= $heureDeb && $heureFin<=$heureFinale)){ 

    echo '<td class = "'.$value['type_activité'].'"><a href=./reservation.php?val='.$value['id'].'>'. $value['titre'] . '<span class="tooltiptext">'.$value['login'].'</span>'.'</a></td>';

}      
    if ($value['type_activité'] == "social"){ ?>
        <style>.social  {background-color: #FFD3B4;
        }
        .social .tooltiptext {
                    visibility: hidden;
                    width: 120px;
                    background-color: black;
                    color: #fff;
                    text-align: center;
                    padding: 5px 0;
                    border-radius: 6px;
                    position: absolute;
                    z-index: 1;
                    }

        .social:hover .tooltiptext {
            visibility: visible;
                }
        </style><?php;
    }elseif ($value['type_activité'] == "loisirs"){ ?>
        <style>.loisirs  {background-color: #FFAAA7;
                        }
                .loisirs .tooltiptext {
                    visibility: hidden;
                    width: 120px;
                    background-color: black;
                    color: #fff;
                    text-align: center;
                    padding: 5px 0;
                    border-radius: 6px;
                    position: absolute;
                    z-index: 1;
                    }

                .loisirs:hover .tooltiptext {
                    visibility: visible;
                        }</style><?php ;
    }elseif ($value['type_activité'] == "scolaire"){ ?>
        <style>.scolaire  {background-color: #98DDCA;
        }
        .scolaire .tooltiptext {
                    visibility: hidden;
                    width: 120px;
                    background-color: black;
                    color: #fff;
                    text-align: center;
                    padding: 5px 0;
                    border-radius: 6px;
                    position: absolute;
                    z-index: 1;
                    }

        .scolaire:hover .tooltiptext {
            visibility: visible;
                }
        </style><?php ;
    }elseif ($value['type_activité'] == "sport"){ ?>
        <style>.sport  {background-color: #D5ECC2;
        }
        .sport .tooltiptext {
                    visibility: hidden;
                    width: 120px;
                    background-color: black;
                    color: #fff;
                    text-align: center;
                    padding: 5px 0;
                    border-radius: 6px;
                    position: absolute;
                    z-index: 1;
                    }

        .sport:hover .tooltiptext {
            visibility: visible;
                }
        </style><?php;
    }elseif ($value['type_activité'] == "festivites"){ ?>
        <style>.festivites  {background-color: #F6DFEB;
            }
        .festivites .tooltiptext {
                visibility: hidden;
                width: 120px;
                background-color: black;
                color: #fff;
                text-align: center;
                padding: 5px 0;
                border-radius: 6px;
                position: absolute;
                z-index: 1;
                }

        .festivites:hover .tooltiptext {
            visibility: visible;
                }  
            </style><?php ;
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
    <title>Planning || UC</title>
</head>
<body>

<table>
    <thead>
        <tr>
            <th><?php echo $monday; ?></th>
            <th><?php echo $tuesday; ?></th>
            <th><?php echo $wednesday; ?></th>
            <th><?php echo $thursday; ?></th>
            <th><?php echo $friday; ?></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($fetchPlanning as $value){
            $debut = $value['debut'];
            $fin = $value['fin'];
                // echo $debut;
                $time = strtotime($debut);
                $time1 = strtotime($fin);
                $jourDebut = date("l d-m-y",$time);
                $heureDebut = date("H:i",$time);
                $heureFin = date("H:i",$time);
                $couleur = $value['type_activité'];
            }
            

                ?>
                <!-- il faut le mm nb de td que de colonne en haut pour que ça marche -->
        <tr><td><?php echo $eight ?></td>
        <td><?php creneaux($monday, $eight,$nine); 
         creneaux($tuesday, $eight,$nine); 
         creneaux($wednesday, $eight, $nine);
         creneaux($thursday, $eight, $nine);
         creneaux($friday, $eight, $nine);
         ?>
        </td></tr>
        <tr><td><?php echo $nine ?></td>
        <td><?php creneaux($monday, $nine,$ten); 
         creneaux($tuesday, $nine,$ten); 
         creneaux($wednesday, $nine, $ten);
         creneaux($thursday, $nine, $ten);
         creneaux($friday, $nine, $ten);
         ?>
        </td></tr>
        <tr><td><?php echo $ten ?></td>
        <td><?php creneaux($monday, $ten,$eleven); 
         creneaux($tuesday, $ten,$eleven); 
         creneaux($wednesday, $ten, $eleven);
         creneaux($thursday, $ten, $eleven);
         creneaux($friday, $ten, $eleven);
         ?>
        </td></tr>
        <tr><td><?php echo $eleven ?></td>
        <?php creneaux($monday, $eleven,$twelve); 
         creneaux($tuesday, $eleven,$twelve); 
         creneaux($wednesday, $eleven, $twelve);
         creneaux($thursday, $eleven, $twelve);
         creneaux($friday, $eleven, $twelve);
         ?>
        </tr>
        <tr><td><?php echo $twelve ?></td>
        <?php creneaux($monday, $twelve,$thirteen); 
         creneaux($tuesday, $twelve,$thirteen); 
         creneaux($wednesday, $twelve, $thirteen);
         creneaux($thursday, $twelve, $thirteen);
         creneaux($friday, $twelve, $thirteen);
         ?>
        </tr>
        <tr><td><?php echo $thirteen ?></td>
        <?php creneaux($monday, $thirteen,$fourteen); 
         creneaux($tuesday, $thirteen,$fourteen); 
         creneaux($wednesday, $thirteen, $fourteen);
         creneaux($thursday, $thirteen, $fourteen);
         creneaux($friday, $thirteen, $fourteen);
         ?>
        </tr>
        <tr><td><?php echo $fourteen ?></td>
        <?php creneaux($monday, $fourteen,$fifteen); 
         creneaux($tuesday, $fourteen,$fifteen); 
         creneaux($wednesday, $fourteen, $fifteen);
         creneaux($thursday, $fourteen, $fifteen);
         creneaux($friday, $fourteen, $fifteen);
         ?>
        </tr>
        <tr><td><?php echo $fifteen; ?></td>
        <?php creneaux($monday, $fifteen,$sixteen); 
         creneaux($tuesday, $fifteen,$sixteen); 
         creneaux($wednesday, $fifteen, $sixteen);
         creneaux($thursday, $fifteen, $sixteen);
         creneaux($friday, $fifteen, $sixteen);
         ?>
        </tr>
        <tr><td><?php echo $sixteen ?></td>
        <?php creneaux($monday, $sixteen,$seventeen); 
         creneaux($tuesday, $sixteen,$seventeen); 
         creneaux($wednesday, $sixteen, $seventeen);
         creneaux($thursday, $sixteen, $seventeen);
         creneaux($friday, $sixteen, $seventeen);
         ?>
        </tr>
        <tr><td><?php echo $seventeen ?></td>
        <?php creneaux($monday, $seventeen,$eighteen); 
         creneaux($tuesday, $seventeen,$eighteen); 
         creneaux($wednesday, $seventeen, $eighteen);
         creneaux($thursday, $seventeen, $eighteen);
         creneaux($friday, $seventeen, $eighteen);
         ?>
        </tr>
        <tr><td><?php echo $eighteen ?></td>
        <?php creneaux($monday, $eighteen,$nineteen); 
         creneaux($tuesday, $eighteen,$nineteen); 
         creneaux($wednesday, $eighteen, $nineteen);
         creneaux($thursday, $eighteen, $nineteen);
         creneaux($friday, $eighteen, $nineteen);
         ?>
        </tr>
        <tr><td><?php echo $nineteen ?></td>
        <?php creneaux($monday, $nineteen,$eight); 
         creneaux($tuesday, $nineteen,$eight); 
         creneaux($wednesday, $nineteen, $eight);
         creneaux($thursday, $nineteen, $eight);
         creneaux($friday, $nineteen, $eight);
         ?>
        </tr>
    </tbody>
</table>

</body>
</html>

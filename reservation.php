<!-- Cette page affiche le nom du créateur, le titre de l’événement, la
description, l’heure de début et de fin. Pour savoir quel évènement afficher,
vous devez récupérer l’id de l’événement en utilisant la méthode get. (ex :
http://localhost/reservationsalles/evenement/?id=1) Seuls les personnes
connectées peuvent accéder aux événements. -->

<?php
session_start();

// $connect = mysqli_connect('localhost', 'root', '', 'reservationsalles');
$connect = mysqli_connect('localhost', 'laurasavickaite', 'Lilirosesa1997.', 'laura-savickaite_reservationsalles');
mysqli_set_charset($connect,"utf8");

if(!isset($_SESSION['login'])){
    header('Location:index.php');
}else {

    $queryReservation = mysqli_query($connect, "SELECT utilisateurs.login, utilisateurs.imgprofil, reservations.id, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité, reservations.description FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id WHERE reservations.id = '".@$_GET['val']."'");
    $fetchReservation = mysqli_fetch_assoc($queryReservation);

    @$debut = $fetchReservation['debut'];
    @$fin = $fetchReservation['fin'];
    @$deb = strtotime($debut);
    @$fi = strtotime($fin);
    $jDebut = date("l d-m-y",$deb);
    $hDebut = date("H:00",$deb);
    $hFin = date("H:00",$fi);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Réservation || BookWithMe</title>
    <link rel="shortcut icon" type="image/jpg" href="Images/planner.png"/>
</head>
<body>
    <header>
        <section class="navbar">
            <a id="rose" href="index.php"><p>Index</p></a>
            <a id="bleu" href="profil.php"><p>Mon profil</p></a> 
            <a id="violet" href="planning.php"><p>Planning</p></a>
            <a id="jaune" href="reservation-form.php"><p>Add an event</p></a> 
            <form action="deconnexion.php" method="post">
                <button class="boutondeco" type="submit" name="deco">Deconnexion</button>
            </form>
        </section>
    </header>
    <main>
        <article id="booksinfo">
            <!-- HOVER COULEUR SELON LE TYPE DACTIVITE -->
            <?php
            if($fetchReservation['type_activité']=="sport"){ ?>
                    <style>
                        h2::before {  
                            transform: scaleX(0);
                            transform-origin: bottom right;
                            }
                        
                        h2:hover::before {
                            transform: scaleX(1);
                            transform-origin: bottom left;
                            }

                        h2::before {
                            content: " ";
                            display: block;
                            position: absolute;
                            inset: 0 0 0 0;
                            background-color: #D5ECC2;
                            z-index: -1;
                            transition: transform .3s ease;
                            } 
                    </style>
            <?php
            }elseif ($fetchReservation['type_activité']=="scolaire"){ ?>
                    <style>
                        h2::before {  
                        transform: scaleX(0);
                        transform-origin: bottom right;
                        }

                        h2:hover::before {
                        transform: scaleX(1);
                        transform-origin: bottom left;
                        }

                        h2::before {
                        content: " ";
                        display: block;
                        position: absolute;
                        top: 0; right: 0; bottom: 0; left: 0;
                        inset: 0 0 0 0;
                        background-color: #98DDCA;
                        z-index: -1;
                        transition: transform .3s ease;
                            }
                    </style>
            <?php
            }elseif ($fetchReservation['type_activité']=="loisirs"){?>
                    <style>
                        h2::before {  
                        transform: scaleX(0);
                        transform-origin: bottom right;
                        }

                        h2:hover::before {
                        transform: scaleX(1);
                        transform-origin: bottom left;
                        }

                        h2::before {
                        content: " ";
                        display: block;
                        position: absolute;
                        top: 0; right: 0; bottom: 0; left: 0;
                        inset: 0 0 0 0;
                        background-color: #FFAAA7;
                        z-index: -1;
                        transition: transform .3s ease;
                            }
                    </style>
            <?php    
            }elseif ($fetchReservation['type_activité']=="social"){?>
                    <style>
                        h2::before {  
                        transform: scaleX(0);
                        transform-origin: bottom right;
                        }

                        h2:hover::before {
                        transform: scaleX(1);
                        transform-origin: bottom left;
                        }

                        h2::before {
                        content: " ";
                        display: block;
                        position: absolute;
                        top: 0; right: 0; bottom: 0; left: 0;
                        inset: 0 0 0 0;
                        background-color: #FFD3B4;
                        z-index: -1;
                        transition: transform .3s ease;
                            }
                    </style> 
            <?php
            }elseif ($fetchReservation['type_activité']=="festivite"){?>
                    <style>
                        h2::before {  
                        transform: scaleX(0);
                        transform-origin: bottom right;
                        }

                        h2:hover::before {
                        transform: scaleX(1);
                        transform-origin: bottom left;
                        }

                        h2::before {
                        content: " ";
                        display: block;
                        position: absolute;
                        top: 0; right: 0; bottom: 0; left: 0;
                        inset: 0 0 0 0;
                        background-color: #F6DFEB;
                        z-index: -1;
                        transition: transform .3s ease;
                            }
                </style> 
            <?php
            }
            ?>
                <h2><?php echo strtoupper($fetchReservation['titre']); ?></h2>
            <div id="eventby">inscrit par <?php echo @$fetchReservation['login']; ?>             
            <span id="imgreservation">
            <?php if(@!$fetchReservation['imgprofil']){ ?>
                  <img class="imgprofil" src="Uploads/default.png" alt="Profile picture" class='profil' width="50px" height="50px">   
            <?php }else {
              ?>
                <img class="imgprofil" src="Uploads/<?php echo $fetchReservation['imgprofil']; ?>" alt="Profile picture" class='profil' width="50px" height="50px">
          <?php } ?>
            </span>
            </div>

            <div id="eventdescri">
                <h3>Description de l'event</h3>
                <?php echo $fetchReservation['description']; ?>
            </div>

                <div id="jour">
                    <p>Le</p>
                    <div id="echo"><p><?php echo $jDebut;?></p></div>
                </div>
                <div id="time">
                    <div id="debut">
                        <p>De</p>
                        <div><?php echo $hDebut; ?></div>
                    </div>
                    <div id="fin">
                        <p>À</p>
                        <div><?php echo $hFin; ?></div>
                    </div>
                </div>

        </article>

    </main>
    <footer>
        
    </footer>
</body>
</html>
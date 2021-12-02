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
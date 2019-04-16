<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $bonus = new Bonus();
    $bon = $bons = $bonus->getById($_POST['bonus']);
    $concert = new Concert();
    $con = $concert->getById($_POST['concert']);

    $ticket = new TicketBuy($_POST['name'], $_POST['email'], $_POST['telefon'], $bon, $con);
    $ticket->create();

    header('Location: notpaid');
} else {
    //initialize for first entry

    $bonus = new Bonus();
    $bons = array();
    $bons = $bonus->getAllBonus();        
    
    $concert = new Concert();
    $concerts = array();
    $concerts = $concert->getAllConcerts();

    require 'app/Views/addticket.view.php';
}
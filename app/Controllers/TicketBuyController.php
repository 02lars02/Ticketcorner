<?php
$isEdit = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'app/Models/Validator.php';
    if(Validator::isEmailCorrect($_POST['email'])){
        if(Validator::isPhoneCorrect($_POST['telefon'])) {

            $bonus = new Bonus();
            $bon = $bons = $bonus->getById($_POST['bonus']);
            $concert = new Concert();
            $con = $concert->getById($_POST['concert']);

            $ticket = new TicketBuy($_POST['name'], $_POST['email'], $_POST['telefon'], $bon, $con);
            $ticket->create();

            header('Location: notpaid');
        } else {
            header('Location: addTicket');
        }
    } else {
        header('Location: addTicket');
    }
} else {
    $bonus = new Bonus();
    $bons = array();
    $bons = $bonus->getAllBonus();        
    
    $concert = new Concert();
    $concerts = array();
    $concerts = $concert->getAllConcerts();

    require 'app/Views/ticketform.view.php';
}
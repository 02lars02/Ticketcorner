<?php
$isEdit = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(Validator::isEmailCorrect($_POST['email'])){
        if(Validator::isPhoneCorrect($_POST['telefon'])) {

            $bon = Bonus::getById($_POST['bonus']);
            $con = Concert::getById($_POST['concert']);

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
    $bons = array();
    $bons = Bonus::getAllBonus();        
    
    $concerts = array();
    $concerts = COncert::getAllConcerts();

    require 'app/Views/ticketform.view.php';
}
<?php
    $isEdit = true;

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $ticketBuy = TicketBuy::getByID($_POST['id']);
        $ticketBuy->name = $_POST['name'];
        $ticketBuy->email = $_POST['email'];
        $ticketBuy->phone = $_POST['telefon'];
        $ticketBuy->paid = $_POST['paid'] == 'on';
        $ticketBuy->concert = Concert::getById($_POST['concert']);
        $ticketBuy->bonus = Bonus::getById($_POST['bonus']);
        $ticketBuy->update();
        header('Location: notpaid');
    } else if($_GET["id"] == null) {
        header('Location: notpaid');
    } else {
        $ticketBuy = TicketBuy::getByID($_GET["id"]);
        if($ticketBuy == null) {
            header('Location: notpaid');
        } else {
            $bons = Bonus::getAllBonus();        
            
            $concerts = Concert::getAllConcerts();

            require 'app/Views/ticketform.view.php';
        }
    }

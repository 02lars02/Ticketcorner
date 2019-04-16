<?php

    if($_GET["id"] == null) {
        header('Location: notpaid');
    } else {
        $ticketBuy = TicketBuy::getByID($_GET["id"]);
        if($ticketBuy == null) {
            header('Location: notpaid');
        } else {
            $bonus = new Bonus();
            $bons = array();
            $bons = $bonus->getAllBonus();        
            
            $concert = new Concert();
            $concerts = array();
            $concerts = $concert->getAllConcerts();

            require 'app/Views/editticket.view.php';
        }
    }

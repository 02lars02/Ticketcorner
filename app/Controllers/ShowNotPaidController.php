<?php
    require 'app/Models/TicketBuy.php';

    $ticketBuy = new TicketBuy();
    $ticketBuys = $ticketBuy->getNotPaid();

    require 'app/Views/notpaid.view.php';
?>

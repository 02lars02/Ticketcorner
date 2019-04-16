<?php
 
    $ticketBuys = TicketBuy::getNotPaid();

    require 'app/Views/notpaid.view.php';
?>

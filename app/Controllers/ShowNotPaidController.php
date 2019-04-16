<?php
    require 'app/Models/TicketBuy.php';
 
    $ticketBuys = TicketBuy::getNotPaid();

    require 'app/Views/notpaid.view.php';
/*
    $dt1 = new DateTime('2008-03-08 10:00:00');
    
    $dt2 = new DateTime('2008-03-08 12:00:00');

    $interval = $dt1->diff($dt2);
     echo (($interval->invert == 1 ? -1 : 1) * $interval->h);*/
?>

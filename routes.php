<?php

$router = new Router();

$router->define([
    '' => 'app/Controllers/ShowNotPaidController.php',
    'notpaid' => 'app/Controllers/ShowNotPaidController.php',
    'addTicket' => 'app/Controllers/TicketBuyController.php',
    'editTicket' => 'app/Controllers/TicketEditController.php',
    'ticketpaid' => 'app/Controllers/TicketPaidController.php'
]);

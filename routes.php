<?php

$router = new Router();

$router->define([
    'notpaid' => 'app/Controllers/ShowNotPaidController.php',
    '' => 'app/Controllers/TicketBuyController.php',
    'addTicket' => 'app/Controllers/TicketBuyController.php'
]);
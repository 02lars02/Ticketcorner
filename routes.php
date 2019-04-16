<?php

$router = new Router();

$router->define([
    'notpaid' => 'app/Controllers/ShowNotPaidController.php',
    '' => 'app/Controllers/CreateTicketBuyController.php'
]);
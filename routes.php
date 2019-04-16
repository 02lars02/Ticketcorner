<?php

$router = new Router();

$router->define([
    '' => 'app/Controllers/WelcomeController.php',
    'notpaid' => 'app/Controllers/ShowNotPaidController.php'
]);
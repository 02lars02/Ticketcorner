<?php
$isEdit = false;

$nameValidation = array();
$emailValidation = array();
$phoneValidation = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameValidation = Validator::isNameCorrect($_POST['name'] ?? '');
    $emailValidation = Validator::isEmailCorrect($_POST['email'] ?? '');
    $phoneValidation = Validator::isPhoneCorrect($_POST['phone'] ?? '');

    $bon = Bonus::getById($_POST['bonus']);
    $con = Concert::getById($_POST['concert']);

    $ticketBuy = new TicketBuy(trim($_POST['name'] ?? ''), trim($_POST['email'] ?? ''), trim($_POST['phone'] ?? ''), $bon, $con);

    if (sizeof($nameValidation) == 0 && sizeof($emailValidation) == 0 && sizeof($phoneValidation) == 0) {
      $ticketBuy->create();

      header('Location: notpaid');
    }

}

$bons = Bonus::getAllBonus();

$concerts = COncert::getAllConcerts();

require 'app/Views/ticketform.view.php';

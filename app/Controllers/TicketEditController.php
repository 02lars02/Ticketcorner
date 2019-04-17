<?php
    $isEdit = true;

    $nameValidation = array();
    $emailValidation = array();
    $phoneValidation = array();

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
      $nameValidation = Validator::isNameCorrect($_POST['name'] ?? '');
      $emailValidation = Validator::isEmailCorrect($_POST['email'] ?? '');
      $phoneValidation = Validator::isPhoneCorrect($_POST['phone'] ?? '');
      $bonusValidation = Validator::isBonusCorrect($_POST['bonus'] ?? '');
      $concertValidation = Validator :: isConcertCorrect($_POST['concert'] ?? '');

      $ticketBuy = TicketBuy::getByID($_POST['id']);
      $ticketBuy->name = trim($_POST['name'] ?? '');
      $ticketBuy->email = trim($_POST['email'] ?? '');
      $ticketBuy->phone = trim($_POST['phone'] ?? '');
      $ticketBuy->paid = trim($_POST['paid'] ?? '' == 'on');
      $ticketBuy->concert = Concert::getById($_POST['concert'] ?? '1');
      $ticketBuy->bonus = Bonus::getById($_POST['bonus'] ?? '1');

      if (sizeof($nameValidation) == 0 && sizeof($emailValidation) == 0 && sizeof($phoneValidation) == 0 && $bonusValidation && $concertValidation) {
        $ticketBuy->update();
        header('Location: notpaid');
      }
    } else if($_GET["id"] == null || !is_numeric($_GET["id"])) {
        header('Location: notpaid');
    } else {
        $ticketBuy = TicketBuy::getByID($_GET["id"]);
        if($ticketBuy == null) {
            header('Location: notpaid');
        }
    }

    $bons = Bonus::getAllBonus();
    $concerts = Concert::getAllConcerts();
    require 'app/Views/ticketform.view.php';

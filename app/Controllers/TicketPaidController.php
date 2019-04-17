<?php

var_dump($_POST['ids']);
if($_SERVER["REQUEST_METHOD"] == 'POST' && Validator::areIdsCorrect($_POST['ids'] ?? '')) {
  TicketBuy::setPaid($_POST['ids']);
  //header('Location: notpaid');
} else if($_GET["id"] == null || !is_numeric($_GET["id"])) {
  //header('Location: notpaid');
} else {
  TicketBuy::setPaid([$_GET['id']]);
  //header('Location: notpaid');
}

?>

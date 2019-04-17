<?php

if($_SERVER["REQUEST_METHOD"] == 'POST' && Validator::areIdsCorrect($_POST['ids'] ?? '')) {
  TicketBuy::setPaid($_POST['ids']);
} else if(is_numeric($_GET["id"])) {
  TicketBuy::setPaid([$_GET['id']]);
}
header('Location: notpaid');

?>

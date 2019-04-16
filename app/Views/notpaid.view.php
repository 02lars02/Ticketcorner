<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nicht Bezahlte Tickets</title>
    <?php require 'core/basicincludes.php'; ?>
  </head>
  <body>
    <div class="topbar">
      <h1>Nicht bezahlte Tickets</h1>
      <button class="btn btn-primary" onclick="window.location.href='addTicket'">Neu ...</button>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Konzert</th>
          <th>Zahlungsfrist</th>
          <th>Status</th>
          <th>Optionen</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($ticketBuys as $key => $ticketBuy) {
          ?>
          <tr>
            <td><?= $ticketBuy->name ?></td>
            <td><?= $ticketBuy->concert->artist ?></td>
            <td><?= $ticketBuy->getTermDate()->format('d.m.y') ?></td>
            <td><?= $ticketBuy->isOverdue() == 1 ? '	&#8987;'/*Overdue*/ : '&#9203;'/*in Progress*/ ?></td>
            <td><button class="btn btn-info" onclick="window.location.href = 'editTicket?id=<?= $ticketBuy->id ?>'">bearbeiten</button></td>
          </tr>
          <?php
        }
      ?>
      </tbody>
    </table>
  </body>
</html>

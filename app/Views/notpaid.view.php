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
      <a class="btn btn-primary" href="addTicket" role="button">Neu ...</a>
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
            <td class="state"><?= $ticketBuy->isOverdue() == 1 ? '	&#8987;'/*Overdue*/ : '&#9203;'/*in Progress*/ ?></td>
            <td><a class="btn btn-secondary" href="editTicket?id=<?= $ticketBuy->id ?>" role="button">bearbeiten</a></td>
          </tr>
          <?php
        }
      ?>
      </tbody>
    </table>
  </body>
</html>

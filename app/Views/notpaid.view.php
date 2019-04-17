<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nicht Bezahlte Tickets - Tikitas</title>
    <?php require 'core/basicincludes.php'; ?>
  </head>
  <body>
    <form class="" action="ticketpaid" method="post">
      <div class="topbar">
        <h1>Nicht bezahlte Tickets</h1>
        <a class="btn btn-primary" href="addTicket" role="button">Neu ...</a> <input type="submit" id="setPaid" class="btn btn-secondary" name="" value="wurden bezahlt" disabled>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th> <input type="checkbox" id="multi-selector" class="checkbox"  name="all" value="true"> </th>
            <th>Name</th>
            <th>E-Mail</th>
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
              <td> <input type="checkbox" class="checkbox multi-selectable" name="ids[]" value="<?= $ticketBuy->id ?>"> </td>
              <td><?= $ticketBuy->name ?></td>
              <td><?= $ticketBuy->email ?></td>
              <td><?= $ticketBuy->concert->artist ?></td>
              <td><?= $ticketBuy->getTermDate()->format('d.m.Y') ?></td>
              <td class="state"><?= $ticketBuy->isOverdue() == 1 ? '	&#8987;'/*Overdue*/ : '&#9203;'/*in Progress*/ ?></td>
              <td><a class="btn btn-primary" href="editTicket?id=<?= $ticketBuy->id ?>" role="button">bearbeiten</a> <a class="btn btn-secondary" role="button" href="ticketpaid?id=<?= $ticketBuy->id ?>">wurde bezahlt</a></td>
            </tr>
            <?php
          }
        ?>
        </tbody>
      </table>
    </form>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#multi-selector").change(function(){
          if($(this).prop('checked')){
            $(".multi-selectable").prop('checked', true);
            $("#setPaid").prop('disabled', $('.multi-selectable:checked').length == 0);
          } else {
            $(".multi-selectable").prop('checked', false);
            $("#setPaid").prop('disabled', true);
          }
        });

        $(".multi-selectable").change(function(){
          if(!$(this).prop("checked")){
            $("#multi-selector").prop('checked', false);
          } else if($('.multi-selectable:checked').length == $('.multi-selectable').length){
            $("#multi-selector").prop('checked', true);
          }

          $("#setPaid").prop('disabled', $('.multi-selectable:checked').length == 0);
        });
      });
    </script>
  </body>
</html>

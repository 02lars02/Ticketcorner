<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticketkauf bearbeiten</title>
    <?php require 'core/basicincludes.php'; ?>
</head>
<body class="form">


<div class="topbar">
    <h2><?= $isEdit ? 'Ticketkauf bearbeiten' : 'Ticketkauf erfassen' ?></h2>
</div>
<form id="form" action="<?= $isEdit ? 'editTicket' : 'addTicket' ?>" method="post">
    <input type="hidden" name="id" value="<?=$ticketBuy->id?>">
    <div id="error-name" class="error alert alert-danger">
      <ul>
        <li id="error-name-required" class="error error-name">Das Feld Name ist ein Pflichtfeld</li>
        <li id="error-name-length" class="error error-name">Das Feld Name darf maximal 255 Zeichen lang sein</li>
      </ul>
    </div>
    <label for="name">Name *</label>
    <input type="text" id="name" name="name" required class="form-control" value="<?= $ticketBuy->name ?? '' ?>"> <br>
    <div id="error-email" class="error alert alert-danger">
      <ul>
        <li id="error-email-valid" class="error error-email">Bitte geben Sie eine gültige E-Mail-Adresse ein (z.B. max@muster.ch)</li>
        <li id="error-email-required" class="error error-email">Das Feld E-Mail ist ein Pflichtfeld</li>
        <li id="error-email-length" class="error error-email">Das Feld E-Mail darf maximal 255 Zeichen lang sein</li>
      </ul>
    </div>
    <label for="email">E-Mail *</label>
    <input type="email" id="email" name="email" required class="form-control" value="<?= $ticketBuy->email ?? '' ?>"> <br>
    <div id="error-phone" class="error alert alert-danger">
      <ul>
        <li id="error-phone-valid" class="error error-phone">Bitte geben Sie eine gültige Telefonnummer ein (z.B. +41 41 123 45 67)</li>
        <li id="error-phone-length" class="error error-phone">Das Feld Telefon darf maximal 20 Zeichen lang sein</li>
      </ul>
    </div>
    <label for="phone">Telefon</label>
    <input type="tel" id="phone" name="phone" class="form-control" value="<?= $ticketBuy->phone ?? '' ?>"><br>
    <label for="bonus">Treuebonus *</label>
    <select id="bonus" name="bonus" id="bonus" class="form-control">
        <?php foreach ($bons as $oneBon): ?>
            <option value="<?= $oneBon->id ?>" termReduction="<?= $oneBon->termReduction ?>" <?php if(isset($ticketBuy) && $oneBon->id == $ticketBuy->bonus->id) { ?> selected <?php }?>><?= $oneBon->text ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="term">Zahlungsfrist</label>
    <input type="text" id="term" name="term" required class="form-control" disabled> <br>
    <label for="concert">Konzert *</label>
    <select id="concert" name="concert" class="form-control">
        <?php foreach ($concerts as $oneConcert): ?>
            <option value="<?= $oneConcert->id ?>" <?php if(isset($ticketBuy) && $oneConcert->id == $ticketBuy->concert->id) { ?> selected <?php }?>><?= $oneConcert->artist ?></option>
        <?php endforeach; ?>
    </select><br>
    <?php if($isEdit) { ?>
        <input class="checkbox" type="checkbox" id="paid" name="paid" <?php if($ticketBuy->paid == true){?> checked <?php }?>>
        <label for="paid">Bezahlt</label><br>
    <?php } ?>
    <input class="btn btn-primary" type="submit" value="Speichern">
    <button class="btn btn-secondary" onclick="window.location.href='notpaid'">Abbrechen</button>
</form>
<script>
    $(document).ready(function(){
        var createDate = <?= isset($ticketBuy) ? "new Date('" . $ticketBuy->createDate->format(DateTimeInterface::ISO8601) . "')" : "new Date()" ?>;
        updateTermDate();

        $("#form").submit(function(event){

        });

        $('#bonus').change(updateTermDate);

        function updateTermDate(){
            var termDate = new Date(createDate);
            termDate.setDate(createDate.getDate() + 30 - (bonus.options[bonus.selectedIndex].getAttribute("termReduction")));
            $("#term").attr('value', termDate.toLocaleDateString());
        }
    });

</script>
</body>
</html>

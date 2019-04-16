<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticketkauf bearbeiten</title>
    <?php require 'core/basicincludes.php'; ?>
</head>
<body class="form">

<h2>Ticketkauf bearbeiten</h2>
<form action="editTicket" method="post">
    <input type="hidden" name="id" value="<?=$ticketBuy->id?>">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required class="form-control" value="<?= $ticketBuy->name ?? '' ?>"> <br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required class="form-control" value="<?= $ticketBuy->email ?? '' ?>"> <br>
    <label for="telefon">Telefon</label>
    <input type="tel" id="telefon" name="telefon" class="form-control" value="<?= $ticketBuy->phone ?? '' ?>"><br>
    <label for="bonus">Treuebonus</label>
    <select id="bonus" name="bonus" id="bonus" class="form-control">
        <?php foreach ($bons as $oneBon): ?>
            <option value="<?= $oneBon->id ?>" <?php if($oneBon->id == $ticketBuy->bonus->id) { ?> selected <?php }?>><?= $oneBon->text ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="concert">Konzert</label>
    <select id="concert" name="concert" class="form-control">
        <?php foreach ($concerts as $oneConcert): ?>
            <option value="<?= $oneConcert->id ?>" <?php if($oneConcert->id == $ticketBuy->concert->id) { ?> selected <?php }?>><?= $oneConcert->artist ?></option>
        <?php endforeach; ?>
    </select><br>
    <input class="checkbox" type="checkbox" id="paid" name="paid" <?php if($ticketBuy->paid == true){?> checked <?php }?>>
    <label for="paid">Bezahlt</label><br>
    <input class="btn btn-primary" type="submit" value="Speichern">
    <button class="btn btn-default" onclick="window.location.href='notpaid'">Abbrechen</button>
</form>

</body>
</html>

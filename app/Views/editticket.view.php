<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticketkauf bearbeiten</title>
    <?php require 'core/basicincludes.php'; ?>
</head>
<body class="form">

<h2>Ticketkauf bearbeiten</h2>
<form action="addtask" method="post">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required class="form-control"> <br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" required class="form-control"> <br>
    <label for="telefon">Telefon</label>
    <input type="text" id="telefon" name="telefon" class="form-control"><br>
    <label for="bonus">Treuebonus</label>
    <select name="bonus" id="bonus" class="form-control">
        <?php foreach ($bons as $oneBon): ?>
            <option value="<?= $oneBon->id ?>"><?= $oneBon->text ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="concert">Konzert</label>
    <select name="concert" class="form-control">
        <?php foreach ($concerts as $oneConcert): ?>
            <option value="<?= $oneConcert->id ?>"><?= $oneConcert->artist ?></option>
        <?php endforeach; ?>
    </select><br>
    <input class="checkbox" type="checkbox" name="paid">
    <label for="paid">Bezahlt</label><br>
    <input class="btn btn-primary" type="submit" value="Speichern">
    <button class="btn btn-default" onclick="window.location.href='notpaid'">Abbrechen</button>
</form>

</body>
</html>

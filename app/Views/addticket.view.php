<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticketkauf erfassen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body class="form">
<div class="topbar">
    <h2>Ticketkauf erfassen</h2>
</div>
<form action="addTicket" method="post">
    <label for="name" class="control-label">Name</label>
    <input type="text" id="name" name="name" required class="form-control"><br>
    <label for="email" class="control-label">Email</label>
    <input type="email" id="email" name="email" required class="form-control"><br>
    <label for="telefon" class="control-label">Telefon</label>
    <input type="text" id="telefon" name="telefon" class="form-control"><br>
    <label for="bonus" class="control-label">Treuebonus</label>
    <select name="bonus" id="bonus" class="form-control">
        <?php foreach ($bons as $oneBon): ?>
            <option value="<?= $oneBon->id ?>"><?= $oneBon->text ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="concert" class="control-label">Konzert</label>
    <select name="concert" id="concert" class="form-control">
        <?php foreach ($concerts as $oneConcert): ?>
            <option value="<?= $oneConcert->id ?>"><?= $oneConcert->artist ?></option>
        <?php endforeach; ?>
    </select><br>
    <input class="btn btn-primary" type="submit" value="Kauf erfassen">
    <input class="btn btn-default" type="button" value="Abbrechen" onclick="window.location.href='notpaid'">
</form>

</body>
</html>

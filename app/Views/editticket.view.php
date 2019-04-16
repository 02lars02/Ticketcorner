<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticketkauf bearbeiten</title>
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>

<h2>Ticketkauf bearbeiten</h2>
<form action="addtask" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" required> <br>
    <label for="email">Email</label>
    <input type="text" name="email" required> <br>
    <label value="telefon">Telefon</label>
    <input type="text" name="telefon"><br>
    <label value="bonus">Treuebonus</label>
    <select name="bonus">
        <?php foreach ($bons as $oneBon): ?>
            <option value="<?= $oneBon->id ?>"><?= $oneBon->text ?></option>
        <?php endforeach; ?>
    </select><br>
    <label value="concert">Konzert</label>
    <select name="concert">
        <?php foreach ($concerts as $oneConcert): ?>
            <option value="<?= $oneConcert->id ?>"><?= $oneConcert->artist ?></option>
        <?php endforeach; ?>
    </select><br>
    <label value="paid">Bezahlt</label>
    <input type="checkbox" name="paid"><br>
    <input type="submit" value="Kauf erfassen">
</form>

</body>
</html>

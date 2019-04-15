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
        <option value="zero">kein Rabatt</option>
        <option value="five">5% Rabbat</option>
        <option value="ten">10% Rabatt</option>
        <option value="fifteen">15% Rabatt</option>
    </select><br>
    <label value="concert">Konzert</label>
    <select name="concert">
        <?php echo get_concerts(); ?> <!-- help: https://www.youtube.com/watch?v=2FdDU7jYvoI -->
    </select><br>
    <!-- At moment, will not be shown because of undefind methode above -->
    <label value="paid">Bezahlt</label>
    <input type="checkbox" name="paid"><br>
    <input type="submit" value="Kauf erfassen">
</form>

</body>
</html>

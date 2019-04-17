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
    <div id="error-name" class="error alert alert-danger" <?php if(sizeof($nameValidation) > 0 ) {?> style="display: block;" <?php } ?> >
      <ul>
        <li id="error-name-required" class="error error-name" <?php if(in_array(Validator::REQUIRED, $nameValidation)) { ?> style="display: list-item;" <?php } ?> >Das Feld Name ist ein Pflichtfeld</li>
        <li id="error-name-length" class="error error-name" <?php if(in_array(Validator::LENGTH, $nameValidation)) { ?> style="display: list-item;" <?php } ?> >Das Feld Name darf maximal 255 Zeichen lang sein</li>
      </ul>
    </div>
    <label for="name">Name *</label>
    <input type="text" id="name" name="name" class="form-control" value="<?= $ticketBuy->name ?? '' ?>"> <br>
    <div id="error-email" class="error alert alert-danger" <?php if(sizeof($emailValidation) > 0 ) {?> style="display: block;" <?php } ?> >
      <ul>
        <li id="error-email-valid" class="error error-email" <?php if(in_array(Validator::VALID, $emailValidation)) { ?> style="display: list-item;" <?php } ?> >Bitte geben Sie eine gültige E-Mail-Adresse ein (z.B. max@muster.ch)</li>
        <li id="error-email-required" class="error error-email" <?php if(in_array(Validator::REQUIRED, $emailValidation)) { ?> style="display: list-item;" <?php } ?> >Das Feld E-Mail ist ein Pflichtfeld</li>
        <li id="error-email-length" class="error error-email" <?php if(in_array(Validator::LENGTH, $emailValidation)) { ?> style="display: list-item;" <?php } ?> >Das Feld E-Mail darf maximal 255 Zeichen lang sein</li>
      </ul>
    </div>
    <label for="email">E-Mail *</label>
    <input type="email" id="email" name="email" class="form-control" value="<?= $ticketBuy->email ?? '' ?>"> <br>
    <div id="error-phone" class="error alert alert-danger" <?php if(sizeof($phoneValidation) > 0 ) {?> style="display: block;" <?php } ?> >
      <ul>
        <li id="error-phone-valid" class="error error-phone" <?php if(in_array(Validator::VALID, $phoneValidation)) { ?> style="display: list-item;" <?php } ?> >Bitte geben Sie eine gültige Telefonnummer ein (z.B. +41 41 123 45 67)</li>
        <li id="error-phone-length" class="error error-phone" <?php if(in_array(Validator::LENGTH, $phoneValidation)) { ?> style="display: list-item;" <?php } ?> >Das Feld Telefon darf maximal 20 Zeichen lang sein</li>
      </ul>
    </div>
    <label for="phone">Telefon</label>
    <input type="tel" id="phone" name="phone" class="form-control" value="<?= $ticketBuy->phone ?? '' ?>"><br>
    <div id="error-bonus" class="error alert alert-danger" <?php if(!$bonusValidation) {?> style="display: block;" <?php } ?> >
      <ul>
        <li id="error-bonus-required">Bitte wählen Sie einen Treuebonus aus</li>
      </ul>
    </div>
    <label for="bonus">Treuebonus *</label>
    <select id="bonus" name="bonus" id="bonus" class="form-control">
        <?php foreach ($bons as $oneBon): ?>
            <option value="<?= $oneBon->id ?>" termReduction="<?= $oneBon->termReduction ?>" <?php if(isset($ticketBuy) && $oneBon->id == $ticketBuy->bonus->id) { ?> selected <?php }?> ><?= $oneBon->text ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="term">Zahlungsfrist</label>
    <input type="text" id="term" name="term" required class="form-control" disabled> <br>
    <div id="error-concert" class="error alert alert-danger" <?php if(!$concertValidation) {?> style="display: block;" <?php } ?> >
      <ul>
        <li id="error-concert-required">Bitte wählen Sie ein Konzert aus</li>
      </ul>
    </div>
    <label for="concert">Konzert *</label>
    <select id="concert" name="concert" class="form-control">
        <?php foreach ($concerts as $oneConcert): ?>
            <option value="<?= $oneConcert->id ?>" <?php if(isset($ticketBuy) && $oneConcert->id == $ticketBuy->concert->id) { ?> selected <?php }?> ><?= $oneConcert->artist ?></option>
        <?php endforeach; ?>
    </select><br>
    <?php if($isEdit) { ?>
        <input class="checkbox" type="checkbox" id="paid" name="paid" <?php if($ticketBuy->paid == true){?> checked <?php }?> >
        <label for="paid">Bezahlt</label><br>
    <?php } ?>
    <input class="btn btn-primary" type="submit" value="Speichern">
    <a class="btn btn-secondary" role="button" href="notpaid">Abbrechen</a>
</form>
<script>
    $(document).ready(function(){
        var createDate = <?= isset($ticketBuy) ? "new Date('" . $ticketBuy->createDate->format("Y-m-d\Th:m:s") . "')" : "new Date()" ?>;
        updateTermDate();

        $("#form").submit(function(event){
          var name = validateName();
          var email = validateEmail();
          var phone = validatePhone();

          if(!name || !email || !phone){
            event.preventDefault();
          }
        });

        $('#bonus').change(updateTermDate);

        $("#name").focusout(validateName);

        $("#email").focusout(validateEmail);

        $("#phone").focusout(validatePhone);

        function updateTermDate(){
            var bonus = document.querySelector('#bonus');
            var termDate = new Date(createDate);
            termDate.setDate(createDate.getDate() + 30 - (bonus.options[bonus.selectedIndex].getAttribute("termReduction")));
            $("#term").val(termDate.toLocaleDateString());
        }

        function validateName() {
          var toReturn = true;

          var required = validateRequired("name");

          var length = validateLength("name", 255);

          return setContainerVisability("name", required && length);
        }

        function validateEmail() {
          var required = validateRequired("email");

          var length = validateLength("email", 255);

          var valid;
          if (!required || /^.+@.+\..{2,}$/.test($("#email").val().trim())) {
            $("#error-email-valid").css("display", "none");
            valid = true;
          } else {
            $("#error-email-valid").css("display", "list-item");
            valid = false;
          }

          return setContainerVisability("email", required && length && valid);
        }

        function validatePhone() {
          var length = validateLength("phone", 20);

          var isEmpty = $("#phone").val().trim().length < 1;

          var valid;
          if (isEmpty || /^[0-9() +\/-]+$/.test($("#phone").val().trim())) {
            $("#error-phone-valid").css("display", "none");
            valid = true;
          } else {
            $("#error-phone-valid").css("display", "list-item");
            valid = false;
          }

          return setContainerVisability("phone", length && valid);
        }

        function validateRequired(id) {
          if ($("#" + id).val().trim().length < 1) {
            $("#error-" + id + "-required").css("display", "list-item");
            return false;
          } else {
            $("#error-" + id + "-required").css("display", "none");
            return true;
          }
        }

        function validateLength(id, length) {
          if ($("#" + id).val().trim().length > length) {
            $("#error-" + id + "-length").css("display", "list-item");
            return false;
          } else {
            $("#error-" + id + "-length").css("display", "none");
            return true;
          }
        }

        function setContainerVisability(id, toReturn) {
          if (toReturn) {
            $("#error-" + id).css("display", "none");
          } else {
            $("#error-" + id).css("display", "block");
          }
          return toReturn;
        }
    });

</script>
</body>
</html>

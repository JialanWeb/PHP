<div class="container">
<div class="col-med-6 p-2" id="change">
    <form action="./auth/user/insert.php" method="POST" class="row bg-warning bg-opacity-50 px-3 mx-2">
        <div class="p-1 fs-3 fw-bold">Konto erstellen</div>
        <div class="p-1">
            <label for="email">E-Mail</label><span class="small text-danger"> *Pflichter Felder</span>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="p-1">
            <label for="pwd">Passwort</label><span class="small text-danger">*Pflichter Felder</span>
            <input type="password" class="form-control" name="pwd" id="pwd">
            <p class="small text-danger">Verwende mindestens 8 Zeichen bestehend aus Buchstaben, zahlen, Symbolen und ohne Leerzeichen.</p>
        </div>
        <div class="p-1">
            <label for="vorname">Vorname</label><span class="small text-danger">*Pflichter Felder</span>
            <input type="text" class="form-control" name="vorname" id="vorname">
        </div>
        <div class="p-1">
            <label for="nachname">Nachname</label><span class="small text-danger">*Pflichter Felder</span>
            <input type="text" class="form-control" name="nachname" id="nachname">
        </div>
        <div class="p-1">
            <label for="birthday">Auswählen dein Geburtstag：</label>
            <input type="date" id="birthday" name="birthday">
        </div>
        <div class="p-1">
            <label for="quantity">Wie viele Länder haben Sie bisher bereist?</label>
            <input type="number" id="quantity" name="quantity" min="1" max="200">
        </div>
        <div class="p-1">
            <label for="countries">Kannst du einige der Länder nennen, die Sie besucht haben?</label>
            <input type="text" id="countries" name="countries" class="form-control" >
        </div>
        <div class="p-1">
            <button type="submit" class="btn btn-success btn-lg">Konto Erstellen</button>
        </div>
        <input type="hidden" name="csrf_token" value="<?= csrf_token();?>" />
    </form>
</div>
</div>
<form action='/user/saveChangeUser' method="post" class="w-100">
    <div class="form-group w-100">
        <label class="control-label" for="username">Benutzername</label>
        <input required id="username" name="username" type="text" class="form-control" value="<?php echo ($attributes["username"]); ?>">
    </div>
    <div class="form-group">
        <label class="control-label" for="firstname">Vorname</label>
        <input required id="firstname" name="firstname" type="text" class="form-control" value="<?php echo ($attributes["firstname"]); ?>">
    </div>
    <div class="form-group">
        <label class="control-label" for="lastname">Nachname</label>
        <input required id="lastname" name="lastname" type="text" class="form-control" value="<?php echo ($attributes["lastname"]); ?>">
    </div>
    <div class="form-group">
        <label class="control-label" for="email">E-Mail</label>
        <input required id="email" name="email" type="email" class="form-control" value="<?php echo ($attributes["email"]); ?>">
    </div>
    <?php
    if (isset($_SESSION['wrongpwd']) && $_SESSION['wrongpwd'] == true) {
        echo "<p>Falsches Passwort!</p>";
    }
    ?>
    <div class="form-group">
        <label class="control-label" for="password_old">Altes Passwort</label>
        <input required id="password_old" name="password_old" type="password" class="form-control">
    </div>
    <div class="form-group">
        <label class="control-label" for="password_new1">Neues Passwort</label>
        <input required id="password_new1" name="password_new1" type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
    </div>
    <div class="form-group">
        <label class="control-label" for="password_new2">Neues Passwort wiederholen</label>
        <input required id="password_new2" name="password_new2" type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
    </div>
    <button class="btn indigo text-white text-center w-100 ml-0" id="send" type='submit' name='send'>Speichern</button>
</form>
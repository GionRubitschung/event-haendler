<section>    
    <form action='/user/saveChangeUser' method="post">
        <div class="form-group">
            <label class="control-label" for="username">Benutzername</label>
            <input required id="username" name="username" type="text" class="form-control" value="<?php echo($username); ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="firstname">Vorname</label>
            <input required id="firstname" name="firstname" type="text" class="form-control" value="<?php echo($firstname); ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="lastname">Nachname</label>
            <input required id="lastname" name="lastname" type="text" class="form-control" value="<?php echo($lastname); ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="email">E-Mail</label>
            <input required id="email" name="email" type="email" class="form-control" value="<?php echo($email); ?>">
        </div>
        <?php
            if(isset($_SESSION['wrongpwd']) && $_SESSION['wrongpwd'] == true){
                echo "<p>Falsches Passwort!</p>";
            }
        ?>
        <div class="form-group">
            <label class="control-label" for="password_old">Altes Passwort</label>
            <input required id="email" name="password_old" type="password" class="form-control" ttern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
        </div>        
        <div class="form-group">
            <label class="control-label" for="password_new1">Neues Passwort</label>
            <input required id="email" name="password_new1" type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
        </div>
        <div class="form-group">
            <label class="control-label" for="password_new2">Neues Passwort wiederholen</label>
            <input required id="email" name="password_new2" type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
        </div>
        <button type='submit' name='send'>Daten verändern</button>
    </form>
</section>
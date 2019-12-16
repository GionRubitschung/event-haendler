<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo ("
        <form action='/user/logout'>
            <button class='btn btn-primary' type='submit' name='send'>Logout</button>
        </form>
        ");
} else {
    ?>
    <div class="row">
        <div class="col-3"></div>
        <form action="/user/doLogin" method="post" class="col-6">
            <div class="form-group">
                <label class="control-label" for="email">E-Mail</label>
                <input required id="email" name="email" type="email" class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label" for="password">Passwort</label>
                <input required id="password" name="password" type="password" class="form-control">
            </div>
            <?php
                if (isset($error) && $error) {
                    echo ("<h5 class='alert alert-danger'>E-Mail oder Passwort falsch!</h5><br>");
                }
                ?>
            <div class="form-row">
                <button id="send" type="submit" name="send" class="btn indigo text-white col">Login</button>
            </div>
            <div class="form-row">
                <p>Hast du kein Account?<a class="ml-1" href="/user/register">Hier gehts zur Registrierung</a></p>
                <a class="col text-right" href="/">Zurück zur Startseite</a>
            </div>
        </form>
        <div class="col-3"></div>
    </div>
<?php
}
?>
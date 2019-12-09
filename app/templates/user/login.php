<?php
	if (isset ( $_SESSION ['loggedin'] ) && $_SESSION ['loggedin'] == true) {
        echo ("
        <form action='/user/logout'>
            <button type='submit' name='send'>Logout</button>
        </form>
        ");
	} else {
?>
        <div class="row">
            <form action="/user/doLogin" method="post" class="col-6">
                <div class="form-group">
                    <label class="control-label" for="email">E-Mail</label>
                    <input required id="email" name="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Passwort</label>
                    <input required id="password" name="password" type="password" class="form-control">
                </div>
                <button id="send" type="submit" name="send" class="btn btn-primary" >Absenden</button>
            </form>
        </div>
        <div>
            <a>Zur Registrierung</a><br>
            <a>Zurück zur Startseite</a>
        </div>
<?php
    }	
?>

<!-- Import Scripts here-->
<script src="../js/hereScript.js"></script>

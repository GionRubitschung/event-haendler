<div class="row">
	<form action="/user/doCreate" method="post" class="col-6">
		<div class="form-group">
			<label class="control-label" for="username">Username</label>
			<input required id="username" name="username" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label class="control-label" for="password" title='Passwort Voraussetzungen:
            min. 8 Zeichen
            min. 1 Gross- und Kleinbuchstaben
            min. 1 Zahl
            min. 1 Sonderzeichen'>Passwort<sup>?</sup></label>
			<input required id="password1" name="password" type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
		</div>
		<div class="form-group">
			<label class="control-label" for="password2" title='Passwort Voraussetzungen:
            min. 8 Zeichen
            min. 1 Gross- und Kleinbuchstaben
            min. 1 Zahl
            min. 1 Sonderzeichen'>Passwort bestätigen<sup>?</sup></label>
			<input required id="password2" name="password2" type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
		</div>
		<div class="form-group">
		  	<label for="fname">Vorname</label>
	  		<input required id="fname" name="fname" type="text" class="form-control">
		</div>
		<div class="form-group">
		  	<label for="lname">Nachname</label>
	  		<input required id="lname" name="lname" type="text" class="form-control">
		</div>
		<div class="form-group">
		  	<label for="email">Mail</label>
	  		<input required id="email1" name="email" type="email" class="form-control">
		</div>
		<div class='error'><h5 class='alert alert-danger'>E-Mail wird schon verwendet!</h5></div>
		<div class="form-group">
		  	<label for="email2">Mail bestätigen</label>
	  		<input required id="email2" name="email2" type="email" class="form-control">
		</div>
		<button id="send" type="submit" name="send" class="btn btn-primary" >Absenden</button>
	</form>
</div>
<div>
	<a>Zum Login</a><br>
	<a>Zurück zur Startseite</a>
</div>

<!-- Import Scripts here-->
<script src="/js/registerCheck.js"></script>

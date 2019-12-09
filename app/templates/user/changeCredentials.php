<section>    
    <form action='/user/saveChangeUser'>
        <div class="form-group">
            <label class="control-label" for="username"><?php echo($username); ?></label>
            <input required id="username" name="username" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="firstname"><?php echo($firstname); ?></label>
            <input required id="firstname" name="firstname" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="lastname"><?php echo($lastname); ?></label>
            <input required id="lastname" name="lastname" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="email"><?php echo($email); ?></label>
            <input required id="email" name="email" type="email" class="form-control">
        </div>
        <button type='submit' name='send'>Daten verändern</button>
    </form>
</section>
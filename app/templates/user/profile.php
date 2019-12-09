<section>
    <h2>Nutzerdaten</h2>
    <p>Nachname: <?= $_SESSION['name']; ?></p>
    <p>Vorname: <?= $_SESSION['firstname']; ?></p>
    <p>E-Mail: <?= $_SESSION['email']; ?></p>
    <form action='/user/changeUser'>
        <button type='submit' name='send'>Daten verändern</button>
    </form>
</section>
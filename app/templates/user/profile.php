<section>
    <h2>Nutzerdaten</h2>
    <p>Nachname: <?= htmlspecialchars($_SESSION['name']); ?></p>
    <p>Vorname: <?= htmlspecialchars($_SESSION['firstname']); ?></p>
    <p>E-Mail: <?= htmlspecialchars($_SESSION['email']); ?></p>
    <form action='/user/changeUser'>
        <button type='submit' name='send'>Daten verändern</button>
    </form>
</section>

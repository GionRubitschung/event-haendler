<div class="column pt-3 pb-3 border-bottom">
	<div class="column">
		<div class="col text-center">
			<a href="/events/user">Meine Events</a>
		</div>
		<div class="col text-center">
			<input class="form-control" type="text" placeholder="Search" aria-label="Search">
		</div>
	</div>
</div>
<div>
	<?php if (empty($events)) : ?>
		<div class="dhd">
			<h2 class="item title">Keine Events gefunden.</h2>
		</div>
	<?php else : ?>
		<?php foreach ($events as $event) : ?>
			<div class="card mt-2 mb-2">
				<div class="card-body">
					<h5 class="card-title"><?= $event->title ?></h5>
					<p class="card-text">Beschreibung: <span><?= $event->description ?></span></p>
					<p class="card-link text-rigth">Veranstalter: <a href="user/query?q=<?= $event->idOwner; ?>"><?= $event->username ?></a></p>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
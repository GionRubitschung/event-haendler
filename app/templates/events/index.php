<div class="column pt-3 pb-3 border-bottom">
	<div class="column">
		<div class="col text-center">
			<a href="/user/events">Meine Events</a>
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
					<p class="card-text"><?= $event->description ?></p>
					<a href="users/<?= $event->idOwner; ?>" class="card-link"></a>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
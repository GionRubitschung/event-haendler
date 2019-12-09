<article class="hreview open special">
	<?php
	function filterEvents($events)
	{
		$params = $_POST["params"];
		echo ($params);
		$filteredEvents = array();
	}
	function js2php($events)
	{
		if (false) {
			// $events = array_filter($events, function ($e) {
			// 	$params = $_POST["params"];
			// 	foreach ($params as $p) {
			// 		if ($p === $e) {
			// 			array_push($filteredEvents, $e);
			// 		}
			// 	}
			// }, ARRAY_FILTER_USE_KEY); // TODO: Fix error
			echo ($events);
			$events = array_diff_key($events, array_flip($_POST['params']));
			echo ($events);
			echo ($_POST["params"]);
		}
		return $events;
	}
	?>
	<?php if (empty($events)) : ?>
		<div class="dhd">
			<h2 class="item title">Keine Events gefunden.</h2>
		</div>
	<?php else : ?>
		<form action="/events" method="post">
			<input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search" id="searchParams" name="params">
			<input type="submit" value="Suchen">
		</form>
		<?php foreach (js2php($events) as $event) : ?>
			<?php if (isset($_POST['params'])) : ?>
				<div>
				<?= json_encode($event) ?>
				<?= json_encode($_POST['params']) ?>
				<? echo (strpos(json_encode($_POST['params']), json_encode($event))) ?>
				</div>
				<?php if (strpos(json_encode($_POST['params']), json_encode($event)) !== false) : ?>
					<div class="card mt-2 mb-2">
						<div class="card-body">
							<h5 class="card-title"><?= $event->title ?></h5>
							<p class="card-text"><?= $event->description ?></p>
							<a href="users/<?= $event->idOwner; ?>" class="card-link"></a>
						</div>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<div class="card mt-2 mb-2">
					<div class="card-body">
						<h5 class="card-title"><?= $event->title ?></h5>
						<p class="card-text"><?= $event->description ?></p>
						<a href="users/<?= $event->idOwner; ?>" class="card-link"></a>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</article>
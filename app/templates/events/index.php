<article class="hreview open special">
	<?php
	function js2php($events)
	{
		if (isset($_POST['events'])) {
			$events = array_filter(json_decode(json_encode($events)), $_POST["params"]);
			echo($events);
			echo($_POST["params"]);
		}
		return $events;
	}
	?>
	<?php if (empty($events)) : ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine User gefunden.</h2>
		</div>
	<?php else : ?>
		<form action="/events" method="post">
			<input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search" id="searchParams" name="params">
			<input type="submit" value="Suchen">
		</form>
		<?php foreach (js2php($events) as $event) : ?>
			<div class="card mt-2 mb-2">
				<div class="card-body">
					<h5 class="card-title"><?= $event->title ?></h5>
					<p class="card-text"><?= $event->description ?></p>
					<a href="users/<?= $event->idOwner; ?>" class="card-link"></a>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</article>

<script>
	var events = JSON.parse(JSON.stringify(<?php echo json_encode($events); ?>));

	function searchEvents() {
		var searchParams = document.getElementById("searchParams").value
		var filteredEvents = JSON.stringify(events.filter(e => e.title.includes(searchParams) || e.description.includes(searchParams) || e.dateOfEvent.includes(searchParams)))
		console.log(filteredEvents)
		var xhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
		xhttp.open("POST", "/events", true)
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		console.log(xhttp)
		xhttp.send(`?events=${filteredEvents}`)
	}
</script>
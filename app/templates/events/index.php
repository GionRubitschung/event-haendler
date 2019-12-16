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
					<h5 class="card-title"><?= htmlspecialchars($event->title) ?></h5>
					<p class="card-text"><?= htmlspecialchars($event->description) ?></p>
					<hr>
					<div class="row">
						<div class="col-1">
							<p class="font-weight-bold">Ort</p>
						</div>
						<div class="col">
							<?php
									$display;
									empty($event->namePlace) ? $display = "" : $display =  "<p class='card-text'><span>" . htmlspecialchars($event->namePlace) . "</span></p>";
									echo $display;
									?>
							<p class="card-text">
								<span><?= htmlspecialchars($event->street) ?></span>
								<?php
										$display;
										empty($event->streetNbr) ? $display = "" : $display =  "<span>" . htmlspecialchars($event->streetNbr) . "</span>";
										echo $display;
										?>
							</p>
							<p class="card-text">
								<span><?= htmlspecialchars($event->plz) ?></span>
								<span><?= htmlspecialchars($event->place) ?></span>
							</p>
						</div>
						<div class="col-1">
							<p class="font-weight-bold">Datum</p>
						</div>
						<div class="col">
							<p class="card-text">
								<u>Datum:</u> <?= htmlspecialchars(date("d.M.Y", strtotime($event->dateOfEvent))) ?>
							</p>
							<p class="card-text">
								<u>Uhrzeit:</u> <?= htmlspecialchars(date("H:i", strtotime($event->dateOfEvent))) ?>
							</p>
						</div>
						<div class="col">
							<p class="card-link text-rigth font-weight-bold">Veranstalter: <a href="user/query?q=<?= htmlspecialchars($event->idOwner); ?>"><?= htmlspecialchars($event->username) ?></a></p>
						</div>
						<div class="col">
							<a class="col btn indigo text-white text-center mt-0" href="">Anmelden</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
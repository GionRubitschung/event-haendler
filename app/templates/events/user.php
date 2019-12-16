<div class="column pt-3 pb-3 border-bottom">
    <div class="column">
        <div class="col text-center">
            <a href="/events">Alle Events</a>
        </div>
        <div class="row">
            <div class="col text-left">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </div>
            <div class="col tex-right">
                <a href="/events/create">Neues Event erstellen</a>
            </div>
        </div>
    </div>
</div>
<div>
    <?php if (empty($events)) : ?>
        <div class="dhd">
            <h2 class="item title">Du hast noch keine Events erstellt!</h2>
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
                        <div class="col">
                            <div class="column">
                                <a class="col btn indigo text-white text-center" href="/events/update?id=<?= $event->id; ?>">Bearbeiten</a>
                                <div class="col-5"></div>
                                <a class="col btn alert-danger text-black text-black" href="/events/delete?id=<?= $event->id; ?>">Löschen</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
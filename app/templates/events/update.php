<div class="row">
    <form action="/events/doUpdate?id=<?php echo $event->id; ?>" method="post" class="w-100">
        <div class="form-group">
            <label class="control-label" for="title">Titel</label>
            <input required id="title" name="title" type="text" class="form-control" value="<?php echo $event->title; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Beschreibung</label>
            <textarea required id="description" name="description" type="text" class="form-control" rows="10"><?php echo $event->description; ?></textarea>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label class="control-label" for="date">Datum des Events</label>
                    <input required id="date" name="date" type="date" class="form-control" value="<?php $date = date_create($event->dateOfEvent);
                                                                                                    echo date_format($date, "Y-m-d"); ?>">
                </div>
                <div class="col">
                    <label class="control-label" for="time">Zeit des Events</label>
                    <input required id="date" name="time" type="time" class="form-control" value="<?php $time = date_create($event->dateOfEvent);
                                                                                                    echo date_format($time, "H:i:s"); ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h5 class="text-center">Adresse</h5>
        </div>
        <div class="form-group">
            <label class="control-label" for="namePlace">Name des Ortes (optional)</label>
            <input type="text" id="namePlace" name="namePlace" class="form-control" value="<?php echo $event->namePlace; ?>">
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-8">
                    <label class="control-label" for="street">Strasse</label>
                    <input required id="street" name="street" type="text" class="form-control" value="<?php echo $event->street; ?>">
                </div>
                <div class="col-4">
                    <label class="control-label" for="streetNbr">Strassen Nr.</label>
                    <input id="streetNbr" name="streetNbr" type="number" class="form-control" value="<?php echo $event->streetNbr; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-4">
                    <label class="control-label" for="plz">Postleihzahl</label>
                    <input required id="plz" name="plz" type="number" class="form-control" value="<?php echo $event->plz; ?>">
                </div>
                <div class="col-8">
                    <label class="control-label" for="place">Ort</label>
                    <input required id="place" name="place" type="text" class="form-control" value="<?php echo $event->place; ?>">
                </div>
            </div>
        </div>
        <div class="form-row">
            <button id="send" type="submit" name="send" class="col btn indigo w-50 text-white">Speichern</button>
            <a href="/events/user" class="col btn indigo ml-0 w-50 text-white border-none">Abbrechen</a>
        </div>
    </form>
</div>
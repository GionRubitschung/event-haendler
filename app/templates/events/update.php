<div>
    <form action="/events/doUpdate?id=<?php echo $event->id; ?>" method="post" class="col-6">
        <div class="form-group">
            <label class="control-label" for="title">Titel</label>
            <input required id="title" name="title" type="text" class="form-control" value="<?php echo $event->title; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Beschreibung</label>
            <textarea required id="description" name="description" type="text" class="form-control"><?php echo $event->description; ?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" for="date">Datum des Events</label>
            <input required id="date" name="date" type="date" class="form-control" value="<?php $date = date_create($event->dateOfEvent);
                                                                                            echo date_format($date, "Y-m-d"); ?>">
        </div>
        <button id="send" type="submit" name="send" class="btn btn-primary">Speichern</button>
    </form>
</div>
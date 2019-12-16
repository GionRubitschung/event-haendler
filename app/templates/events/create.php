<div class="row">
    <form action="/events/doCreate" method="post" class="col-6">
        <div class="form-group">
            <label class="control-label" for="title">Titel</label>
            <input required id="title" name="title" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Beschreibung</label>
            <textarea required id="description" name="description" type="text" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" for="date">Datum des Events</label>
            <input required id="date" name="date" type="date" class="form-control">
        </div>
        <button id="send" type="submit" name="send" class="btn btn-primary">Hinzufügen</button>
    </form>
</div>
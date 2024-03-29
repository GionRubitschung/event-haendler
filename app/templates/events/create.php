<div class="row">
    <form action="/events/doCreate" method="post" class="w-100">
        <div class="form-group">
            <label class="control-label" for="title">Titel</label>
            <input required id="title" name="title" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Beschreibung</label>
            <textarea required id="description" name="description" type="text" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label class="control-label" for="date">Datum des Events</label>
                    <input required id="date" name="date" type="date" class="form-control">
                </div>
                <div class="col">
                    <label class="control-label" for="time">Zeit des Events</label>
                    <input required id="date" name="time" type="time" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h5 class="text-center">Adresse</h5>
        </div>
        <div class="form-group">
            <label class="control-label" for="namePlace">Name des Ortes (optional)</label>
            <input type="text" id="namePlace" name="namePlace" class="form-control">
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-8">
                    <label class="control-label" for="date">Strasse</label>
                    <input required id="street" name="street" type="text" class="form-control">
                </div>
                <div class="col-4">
                    <label class="control-label" for="date">Strassen Nr.</label>
                    <input id="streetNbr" name="streetNbr" type="number" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-4">
                    <label class="control-label" for="plz">Postleihzahl</label>
                    <input id="plz" name="plz" type="number" class="form-control">
                </div>
                <div class="col-8">
                    <label class="control-label" for="place">Ort</label>
                    <input required id="place" name="place" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-row">
            <button id="send" type="submit" name="send" class="col btn indigo w-50 text-white">Hinzufügen</button>
            <a href="/events/user" class="col btn indigo ml-0 w-50 text-white border-none">Abbrechen</a>
        </div>
    </form>
</div>
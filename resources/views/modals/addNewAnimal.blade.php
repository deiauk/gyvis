<div id="add-animal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
            {{ csrf_field() }}
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pridėti gyvūną</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="number" class="control-label col-sm-3">Numerėlis</label>
                    <div class="col-sm-8">
                        <input type="text" name="number" id="number" class="form-control nr-val" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-3">Vardas</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" id="name" class="form-control description-val">
                    </div>
                </div>
                <div class="form-group">
                    <label for="live-being" class="control-label col-sm-3">Gyvis</label>
                    <div class="col-sm-8">
                        <input type="text" name="live-being" id="live-being" class="form-control live-being">
                    </div>
                </div>
                <div class="form-group">
                    <label for="breed-being" class="control-label col-sm-3">Veislės vardas</label>
                    <div class="col-sm-8">
                        <input type="text" name="breed-being" id="breed-being" class="form-control breed-being">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="control-label col-sm-3">Lytis</label>
                    <div class="col-sm-8">
                        <label for="g1">Vyras</label>
                        <input type="radio" name="gender" value="1" id="g1" class="male">
                        &#8194
                        <label for="g2">Moteris</label>
                        <input type="radio" name="gender" value="2" id="g2" class="female">
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="control-label col-sm-3">Spalva</label>
                    <div class="col-sm-8">
                        <input type="text" name="color" id="color" class="form-control color" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday" class="control-label col-sm-3">Gimtadienis</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <input type="text" name="birthday" id="birthday" class="date form-control birthday" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mother" class="control-label col-sm-3">Mama</label>
                    <div class="col-sm-8">
                        <input type="text" name="mother" id="mother" class="form-control mother" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="father" class="control-label col-sm-3">Tėtis</label>
                    <div class="col-sm-8">
                        <input type="text" name="father" id="father" class="form-control father" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bodytext" class="control-label col-sm-3">Aprašymas</label>
                    <div class="col-sm-8">
                        <textarea name="bodytext" id="bodytext" class="form-control description-user" minlength="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg btn-block js-save-new-animal">Išsaugoti</button>
            </div>
            </form>
        </div>
    </div>
</div>
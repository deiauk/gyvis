<div id="edit-animal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="edit-animal" onsubmit="return false">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Redaguoti gyvūno įrašą</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nr-edit-val" class="control-label col-sm-3">Numerėlis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control nr-val" id="nr-edit-val" required>
                            <span class="help-block err-number">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description-edit-val" class="control-label col-sm-3">Vardas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control description-val" id="description-edit-val">
                            <span class="help-block err-name">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="live-being" class="control-label col-sm-3">Gyvis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control live-being" id="live-being-edit-val">
                            <span class="help-block err-livebeing">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breed-being" class="control-label col-sm-3">Veislės vardas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control breed-being" id="breed-being-edit-val">
                            <span class="help-block err-breed">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender-edit-val" class="control-label col-sm-3">Lytis</label>
                        <div class="col-sm-8">
                            <label for="g1">Vyriška</label>
                            <input type="radio" name="gender" value="1" id="g1" class="male">
                            &#8194
                            <label for="g2">Moteriška</label>
                            <input type="radio" name="gender" value="2" id="g2" class="female">
                            <span class="help-block err-gender">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color-edit-val" class="control-label col-sm-3">Spalva</label>
                        <div class="col-sm-8">
                            <input type="text" name="color" id="color-edit-val" class="form-control color">
                            <span class="help-block err-color">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="control-label col-sm-3">Gimtadienis</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="date" name="birthday" class="date form-control birthday" id="birthday"
                                       required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-birthday">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mother-edit-val" class="control-label col-sm-3">Mama</label>
                        <div class="col-sm-8">
                            <input type="text" name="mother" class="form-control mother" id="mother-edit-val" required>
                            <span class="help-block err-mother">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="father-edit-val" class="control-label col-sm-3">father</label>
                        <div class="col-sm-8">
                            <input type="text" name="father" class="form-control father" id="father-edit-val" required>
                            <span class="help-block err-father">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edited-description" class="control-label col-sm-3">Aprašymas</label>
                        <div class="col-sm-8">
                            <textarea name="bodytext" id="edited-description" class="description-user form-control"
                                      minlength="10"></textarea>
                            <span class="help-block err-desc">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-save-edited-animal">Išsaugoti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
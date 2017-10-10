<div id="add-heat" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pridėti rujos įrašą</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="number" class="control-label col-sm-3">Karvės numeris</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control number" id="number" name="number" required>
                            <span class="help-block err-number">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="calving_date" class="control-label col-sm-3">Karvės veršiavimosi data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control calving_date" name="calving_date" id="calving_date" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-calving_date">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="heat_date" class="control-label col-sm-3">Pastebėta ruja</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control heat_date" name="heat_date" id="heat_date" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-heat_date">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="calving_date_expected" class="control-label col-sm-3">Apsiveršiavimo data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control calving_date_expected" name="calving_date_expected" id="calving_date_expected" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-calving_date_expected">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="control-label col-sm-3">Pastebėjimai</label>
                        <div class="col-sm-8">
                            <textarea name="notes" id="notes" class="form-control notes"></textarea>
                            <span class="help-block err-notes">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-add-new-heat"><i class="fa fa-floppy-o" aria-hidden="true"></i> Išsaugoti</button>
                </div>
            </form>
        </div>
    </div>
</div>
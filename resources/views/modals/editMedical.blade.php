<div id="edit-medicine-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Prdėti medikamentą</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-med-date" class="control-label col-sm-3">Data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control filldate" name="filldate" id="edit-med-date" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-filldate">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label col-sm-3">Pavadinimas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control medicname" name="name" id="edit-med-medicname">
                            <span class="help-block err-medicname">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-med-productiondate" class="control-label col-sm-3">Pagaminimo data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control productiondate" name="productiondate" id="edit-med-productiondate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-productiondate">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-med-expirydate" class="control-label col-sm-3">Galioja iki</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control expirydate" name="expirydate" id="edit-med-expirydate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-expirydate">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-med-series" class="control-label col-sm-3">Serija</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control series" min="0" name="series" id="edit-med-series" required>
                            <span class="help-block err-series">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-med-patientregistrationnr" class="control-label col-sm-3">Pacientų registracijos nr.</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control patientregistrationnr" min="0" name="patientregistrationnr" id="edit-med-patientregistrationnr">
                            <span class="help-block err-patientregistrationnr">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-med-quantity" class="control-label col-sm-3">Gauta</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control quantity" min="0" name="quantity" id="edit-med-quantity" required>
                            <span class="help-block err-quantity">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-med-consumed" class="control-label col-sm-3">Sunaudota</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control consumed" min="0" name="consumed" id="edit-med-consumed" required>
                            <span class="help-block err-consumed">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('balance', 'Likutis', array('class' => 'control-label col-sm-3')) }}--}}
                    {{--<div class="col-sm-8">--}}
                    {{--{{ Form::text('bodytext', null, array('class' => 'form-control balance', 'minlength' => '10')) }}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-edit-medicament"><i class="fa fa-floppy-o" aria-hidden="true"></i> Išsaugoti</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="add-medicine" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Prdėti medikamentą</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="filldate" class="control-label col-sm-3">Data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="date" class="date form-control filldate" name="filldate" id="filldate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label col-sm-3">Pavadinimas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control medicname" name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="productiondate" class="control-label col-sm-3">Pagaminimo data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="date" class="date form-control productiondate" name="productiondate" id="productiondate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expirydate" class="control-label col-sm-3">Galioja iki</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="date" class="date form-control expirydate" name="expirydate" id="expirydate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="series" class="control-label col-sm-3">Serija</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control series" min="0" name="series" id="series" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="patientregistrationnr" class="control-label col-sm-3">Pacientų registracijos nr.</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control patientregistrationnr" min="0" name="patientregistrationnr" id="patientregistrationnr" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label col-sm-3">Gauta</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control quantity" min="0" name="quantity" id="quantity" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="consumed" class="control-label col-sm-3">Sunaudota</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control consumed" min="0" name="consumed" id="consumed" required>
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
                    <button type="submit" class="btn btn-success btn-lg btn-block js-add-new-medicament">Išsaugoti</button>
                </div>
            </form>
        </div>
    </div>
</div>
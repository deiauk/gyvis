<div id="add-treatment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pradėti gydymą</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="date" class="control-label col-sm-3">Data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="date" class="date form-control date" name="date" id="date" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number" class="control-label col-sm-3">Gyvulio Nr.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalNumber" name="number" id="number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breed" class="control-label col-sm-3">Gyvulio rūšis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control breed" name="breed" id="breed">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label col-sm-3">Gyvulio amžius</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalAge" name="age" id="age">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="control-label col-sm-3">Gyvulio spalva</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalColor" name="color" id="color">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sickdate" class="control-label col-sm-3">Susirgimo data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="date" class="date form-control sickdate" name="sickdate" id="sickdate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="temperature" class="control-label col-sm-3">Temperatūra</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalTemperature" name="temperature" id="temperature">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pulse" class="control-label col-sm-3">Pulsas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalPulse" name="pulse" id="pulse">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="diagnosis" class="control-label col-sm-3">Diagnozė</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control diagnosis" name="diagnosis" id="diagnosis">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="treatment" class="control-label col-sm-3">Gydymas ir nurodymai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control treatment" name="treatment" id="treatment">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end" class="control-label col-sm-3">Baigtis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control end" name="end" id="end">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="control-label col-sm-3">Pastabos</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control otherInfo" name="info" id="info">
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
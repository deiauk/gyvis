<div id="edit-treatment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Redaguoti gydymą</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="date" class="control-label col-sm-3">Data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control edit-treatment-date" name="date" id="date" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-date">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number" class="control-label col-sm-3">Gyvulio Nr.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-animalNumber" name="number" id="number" required>
                            <span class="help-block err-number">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breed" class="control-label col-sm-3">Gyvulio rūšis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-breed" name="breed" id="breed" required>
                            <span class="help-block err-breed">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label col-sm-3">Gyvulio amžius</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-animalAge" name="age" id="age" required disabled>
                            <span class="help-block err-age">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="control-label col-sm-3">Gyvulio spalva</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-animalColor" name="color" id="color" required>
                            <span class="help-block err-color">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sickdate" class="control-label col-sm-3">Susirgimo data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control edit-treatment-sickdate" name="sickdate" id="sickdate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-sickdate">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="temperature" class="control-label col-sm-3">Temperatūra</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-animalTemperature" name="temperature" id="temperature" required>
                            <span class="help-block err-temperature">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pulse" class="control-label col-sm-3">Pulsas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-animalPulse" name="pulse" id="pulse" required>
                            <span class="help-block err-pulse">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breath" class="control-label col-sm-3">Kvėpavimas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control breath" name="breath" id="breath" required>
                            <span class="help-block err-breath">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="diagnosis" class="control-label col-sm-3">Diagnozė</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-diagnosis" name="diagnosis" id="diagnosis" required>
                            <span class="help-block err-diagnosis">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="treatment" class="control-label col-sm-3">Gydymas ir nurodymai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-treatment" name="treatment" id="treatment" required>
                            <span class="help-block err-treatment">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="medicine" class="control-label col-sm-3">Vaistai</label>
                        <div class="col-sm-8">
                            <select name="medicine" id="medicine" class="form-control edit-treatment-medicine">
                                <option value="-1">---</option>
                                @if(!empty($medicines))
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}">{{ $medicine->from }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="help-block err-medicine">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label col-sm-3">Vaistų kiekis</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control edit-treatment-quantity" name="quantity" id="quantity" min="0" required>
                            <span class="help-block err-quantity">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end" class="control-label col-sm-3">Baigtis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-end" name="end" id="end" required>
                            <span class="help-block err-end">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="control-label col-sm-3">Pastabos</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control edit-treatment-otherInfo" name="info" id="info">
                            <span class="help-block err-info">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-edit-treatment"><i class="fa fa-floppy-o" aria-hidden="true"></i> Išsaugoti</button>
                </div>
            </form>
        </div>
    </div>
</div>
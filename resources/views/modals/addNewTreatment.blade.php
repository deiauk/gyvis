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
                                <input type="text" class="date form-control date" name="date" id="date" required>
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
                            <input type="text" class="form-control breed" name="breed" id="breed" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label col-sm-3">Gyvulio amžius</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalAge" name="age" id="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="control-label col-sm-3">Gyvulio spalva</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalColor" name="color" id="color" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sickdate" class="control-label col-sm-3">Susirgimo data</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control sickdate" name="sickdate" id="sickdate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="temperature" class="control-label col-sm-3">Temperatūra</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalTemperature" name="temperature" id="temperature" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pulse" class="control-label col-sm-3">Pulsas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control animalPulse" name="pulse" id="pulse" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="diagnosis" class="control-label col-sm-3">Diagnozė</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control diagnosis" name="diagnosis" id="diagnosis" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="treatment" class="control-label col-sm-3">Gydymas ir nurodymai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control treatment" name="treatment" id="treatment" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="medicine" class="control-label col-sm-3">Vaistai</label>
                        <div class="col-sm-8">
                            <select name="medicine" id="medicine" class="form-control medicine">
                                <option value="-1">---</option>
                                @if(!empty($medicines))
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}">{{ $medicine->from }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label col-sm-3">Vaistų kiekis</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control quantity" name="quantity" id="quantity" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end" class="control-label col-sm-3">Baigtis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control end" name="end" id="end" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="control-label col-sm-3">Pastabos</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control otherInfo" name="info" id="info" required>
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
                    <button type="submit" class="btn btn-success btn-lg btn-block js-add-new-treatment">Išsaugoti</button>
                </div>
            </form>
        </div>
    </div>
</div>
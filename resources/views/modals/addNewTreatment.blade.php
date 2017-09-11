<div id="add-treatment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(array('class'=>'form-horizontal', 'onsubmit' => 'return false')) }}
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pradėti gydymą</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('date', 'Data', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        <div class="input-group date">
                            {{ Form::date('date', null, array('class' => 'date form-control date', 'required'=> '')) }}
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('animalNumber', 'Gyvulio Nr.', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control animalNumber')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('breed', 'Gyvulio rūšis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control breed')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('animalAge', 'Gyvulio amžius', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control animalAge')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('animalColor', 'Gyvulio spalva', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control animalColor')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('sickdate', 'Susirgimo data', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        <div class="input-group date">
                            {{ Form::date('date', null, array('class' => 'date form-control sickdate', 'required'=> '')) }}
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('animalTemperature', 'Temperatūra', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control animalTemperature')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('animalPulse', 'Pulsas', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control animalPulse')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('diagnosis', 'Diagnozė', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control diagnosis')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('treatment', 'Gydymas ir nurodymai', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control treatment')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('end', 'Baigtis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control end')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('otherInfo', 'Pastabos', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control otherInfo')) }}
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
                {{Form::submit('Išsaugoti', array('class' => 'btn btn-success btn-lg btn-block js-add-new-medicament', null))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
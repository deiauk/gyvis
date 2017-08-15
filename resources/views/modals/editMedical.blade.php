<div id="edit-medicine-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(array('class'=>'form-horizontal', 'onsubmit' => 'return false')) }}
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prdėti medikamentą</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('filldate', 'Data', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        <div class="input-group date">
                            {{ Form::date('date', null, array('class' => 'date form-control filldate', 'required'=> '', 'id' => 'edit-med-date')) }}
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('medicname', 'Pavadinimas', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control medicname', 'id' => 'edit-med-medicname')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('productiondate', 'Pagaminimo data', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        <div class="input-group date">
                            {{ Form::date('date', '', array('class' => 'date form-control productiondate', 'required'=> '', 'id' => 'edit-med-productiondate')) }}
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('expirydate', 'Galioja iki', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        <div class="input-group date">
                            {{ Form::date('date', '', array('class' => 'date form-control expirydate', 'required'=> '', 'id' => 'edit-med-expirydate')) }}
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('series', 'Serija', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::number('number', '', array('class' => 'form-control series', 'required'=> '', 'min' => 0, 'id' => 'edit-med-series')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('patientregistrationnr', 'Pacientų registracijos nr.', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::number('number', '', array('class' => 'form-control patientregistrationnr', 'required'=> '', 'min' => 0, 'id' => 'edit-med-patientregistrationnr')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('quantity', 'Gauta', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::number('number', '', array('class' => 'form-control quantity', 'required'=> '', 'min' => 0, 'id' => 'edit-med-quantity')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('consumed', 'Sundaudota', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::number('number', 0, array('class' => 'form-control consumed', 'required'=> '', 'min' => 0, 'id' => 'edit-med-consumed')) }}
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
                {{Form::submit('Išsaugoti', array('class' => 'btn btn-success btn-lg btn-block js-edit-medicament', null))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
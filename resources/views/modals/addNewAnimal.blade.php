<div id="add-animal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(array('class'=>'form-horizontal', 'onsubmit' => 'return false')) }}
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prdėti gyvūną</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('nr-val', 'Numerėlis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('number', '', array('class' => 'form-control nr-val', 'required'=> '')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('description-val', 'Vardas', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control description-val')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('live-being', 'Gyvis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control live-being')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('breed-being', 'Veislės vardas', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control breed-being')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('gender', 'Lytis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::label('male', 'Vyras') }}
                        {{ Form::radio('gender', 1, false, array('class'=>'male')) }}
                        &#8194
                        {{ Form::label('female', 'Moteris') }}
                        {{ Form::radio('gender', 2, false, array('class'=>'female')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('color', 'Spalva', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control color', 'required'=> '')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('birthday', 'Gimtadienis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        <div class="input-group date">
                            {{ Form::date('date', '', array('class' => 'date form-control birthday', 'required'=> '')) }}
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('mother', 'Mama', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control mother', 'required'=> '')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('father', 'Tėtis', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', '', array('class' => 'form-control father', 'required'=> '')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('description-user', 'Aprašymas', array('class' => 'control-label col-sm-3')) }}
                    <div class="col-sm-8">
                        {{ Form::textarea('bodytext', null, array('class' => 'form-control description-user', 'minlength' => '10')) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{Form::submit('Išsaugoti', array('class' => 'btn btn-success btn-lg btn-block js-save-new-animal', null))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
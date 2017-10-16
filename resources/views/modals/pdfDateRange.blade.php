<div id="get-pdf" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" target="_blank" method="POST" action="{{ isset($category) ? route('pdf.create', ["route" => Route::currentRouteName(), "category" => $category]) : route('pdf.create', ["route" => Route::currentRouteName()]) }}">
                {{ csrf_field() }}
                @if(!empty($search) && !$errors->has('search'))
                    <input type="hidden" name="search" value="{{ $search }}">
                @endif
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Spausdinti</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="startdate" class="control-label col-sm-3">Data nuo</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control startdate" name="startdate" id="startdate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-startdate">
                            <strong></strong>
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="enddate" class="control-label col-sm-3">Data iki</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <input type="text" class="date form-control enddate" name="enddate" id="enddate" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <span class="help-block err-enddate">
                            <strong></strong>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-get-pdf"><i class="fa fa-floppy-o" aria-hidden="true"></i> Atsisiųsti</button>
                </div>
            </form>
        </div>
    </div>
</div>
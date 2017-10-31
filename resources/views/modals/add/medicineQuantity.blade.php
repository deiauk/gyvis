<div id="add-med-quantity" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" onsubmit="return false">
                {{ csrf_field() }}
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pridėti</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="quantity" class="control-label col-sm-3">Pridedamas kiekis</label>
                        <div class="col-sm-8">

                            <input type="number" class="form-control med-quantity" name="quantity" id="quantity" required>

                            <span class="help-block err-quantity">
                            <strong></strong>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-add-med-quantity"><i class="fa fa-floppy-o" aria-hidden="true"></i> Pridėti</button>
                </div>
            </form>
        </div>
    </div>
</div>
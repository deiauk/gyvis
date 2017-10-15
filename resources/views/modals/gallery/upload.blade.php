<div id="gallery-upload" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('gallery.create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Įkelti nuotrauką</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="file" class="col-sm-12">Pasirinkite nuotrauką</label>
                        <div class="col-sm-12">
                            <div class="input-group col-sm-12">
                                <br>
                                <input type="file" class="form-control" name="file" id="file" value="{{ old('file') }}">
                            </div>
                            <span class="help-block err-file">
                                <strong>
                                    @if($errors->has('file'))
                                        {{ $errors->first('file') }}
                                    @endif
                                </strong>
                            </span>
                            <img src="#" id="upload-preview">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block js-upload-photo"><i class="fa fa-floppy-o" aria-hidden="true"></i> Įkelti</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if($errors->has('file'))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#gallery-upload').modal('show');
        });
    </script>
@endif
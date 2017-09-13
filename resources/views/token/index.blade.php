@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    <div class="panel panel-default col-sm-6 col-sm-offset-3">
        <div class="panel-heading">Siųsti registracijos kvietimą</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('token.store') }}" method="post">
                {{ csrf_field() }}
                <label for="email">El. pašto adresas</label>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Siųsti</button>
            </form>
        </div>
    </div>
@endsection


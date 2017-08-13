@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@stop

@section('content')
    <div class="container">
        <div class="menu">
            <a class="aa btn-1 btn-1a" href="{{ route('sarasas') }}">Sąrašas</a>
            <a class="aa btn-1 btn-1c" href="#">Gydymas</a>
            <a class="aa btn-1 btn-1d" href="#">Ruja</a>
            <a class="aa btn-1 btn-1e" href="#">Medikamentų žurnalas</a>
        </div>
    </div>
@stop

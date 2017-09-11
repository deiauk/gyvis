@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@stop

@section('content')
    <div class="container">
        <a href="{{ route('sarasas') }}" class="menu-btn a">
            <span class="icon icon-gear"></span>
            <span class="right"></span>Sąrašas
        </a>

        <a href="{{ route('gydymai') }}" class="menu-btn b">
            <span class="icon icon-gear"></span>
            <span class="right"></span>Gydymas
        </a>

        <a href="{{ route('gydymai') }}" class="menu-btn c">
            <span class="icon icon-gear"></span>
            <span class="right"></span>Ruja
        </a>

        <a href="{{ route('medikamentai') }}" class="menu-btn d">
            <span class="icon icon-gear"></span>
            <span class="right"></span>Medikamentų žurnalas
        </a>
    </div>
@stop

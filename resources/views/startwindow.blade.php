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

        <a href="{{ route('medikamentai', ["category" => 1]) }}" class="menu-btn d">
            <span class="icon icon-gear"></span>
            <span class="right"></span>V. Rasimo medikamentai
        </a>

        <a href="{{ route('medikamentai', ["category" => 2]) }}" class="menu-btn d">
            <span class="icon icon-gear"></span>
            <span class="right"></span>R. Knašio medikamentai
        </a>
    </div>
@stop

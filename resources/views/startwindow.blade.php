@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@stop

@section('content')
    <div class="container">
        <a href="{{ route('sarasas') }}" class="menu-btn a">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;
            <span class="right"></span>Sąrašas
        </a>

        <a href="{{ route('gydymai') }}" class="menu-btn b">
            <i class="fa fa-medkit" aria-hidden="true"></i>&nbsp;
            <span class="right"></span>Gydymas
        </a>

        <a href="{{ route('ruja') }}" class="menu-btn c">
            <i class="fa fa-heart" aria-hidden="true"></i>&nbsp;
            <span class="right"></span>Ruja
        </a>

        <a href="{{ route('medikamentai', ["category" => 1]) }}" class="menu-btn d">
            <i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;
            <span class="right"></span>V. Rasimo medikamentai
        </a>

        <a href="{{ route('medikamentai', ["category" => 2]) }}" class="menu-btn d">
            <i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;
            <span class="right"></span>R. Knašio medikamentai
        </a>

        <a href="{{ route('heat.calving.index') }}" class="menu-btn e">
            <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
            <span class="right"></span>Veršiavimaisi ({{ GeneralHelper::getCalvingsThisMonthCount() }})
        </a>
    </div>
@stop

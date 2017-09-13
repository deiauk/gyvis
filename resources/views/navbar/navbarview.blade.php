<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Gyvis</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Route::currentRouteNamed('sarasas') ? 'active' : '' }}"><a href="{{ route('sarasas') }}">Sąrašas</a></li>
                <li class="{{ Route::currentRouteNamed('gydymai') ? 'active' : '' }}"><a href="{{ route('gydymai') }}">Gydymas</a></li>
                <li class="{{ Route::currentRouteNamed('ruja') ? 'active' : '' }}"><a href="#">Ruja</a></li>
                <li class="{{ Route::currentRouteNamed('medikamentai') ? 'active' : '' }}"><a href="{{ route('medikamentai') }}">Medikamentų žurnalas</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('token.index') }}">Siųsti pakvietimą</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        Atsijungti
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
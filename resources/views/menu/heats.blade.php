@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    @if(auth()->user()->hasRole('admin'))
        @include('modals.add.heat')
        @include('modals.edit.heat')
        @include('modals.confirmDelete')
    @endif
    @include('modals.pdfDateRange')
    <div class="row crud-btns">
        @if(auth()->user()->hasRole('admin'))
            <button type="button" class="btn btn-danger disabled" id="delete-heat"><i class="fa fa-trash" aria-hidden="true"></i> Ištrinti</button>
            <button type="button" class="btn btn-warning disabled" id="edit-heat"><i class="fa fa-pencil" aria-hidden="true"></i> Redaguoti</button>
            <button type="button" class="btn btn-success" id="add-heat" data-toggle="modal" data-target="#add-heat"><i class="fa fa-plus" aria-hidden="true"></i> Pridėti</button>
        @endif
        <button type="submit" class="btn btn-success" id="get-pdf-btn" data-toggle="modal" data-target="#get-pdf"><i class="fa fa-print" aria-hidden="true"></i> Spausdinti</button>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <form action="{{ route('heat.search') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="row row-search">
                        <div class="col-sm-8 no-padding-right">
                            <input type="text" class="form-control" name="search" id="search" value="{{ $search }}">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success">Ieškoti</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-9">
            @if(!empty($animal))
                <div class="table-responsive">
                    <table class="table table-curved table-color">
                        <theader>
                            <tr class="align-rule">
                                <th>Numerėlis</th>
                                <th>Vardas</th>
                                <th>Gyvis</th>
                                <th>Veislės vardas</th>
                                <th>Spava</th>
                                <th>Gimtadienis</th>
                                <th>Mama</th>
                                <th>Tėtis</th>
                            </tr>
                        </theader>
                        <tbody>
                            <tr>
                                <td>{{$animal->number}}</td>
                                <td>{{$animal->name}}</td>
                                <td>{{$animal->liveBeing}}</td>
                                <td>{{$animal->breedName}}</td>
                                <td>{{$animal->color}}</td>
                                <td>{{$animal->birthday}}</td>
                                <td>{{$animal->mother}}</td>
                                <td>{{$animal->father}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            @if(!empty($heats))
                @if(count($heats) > 0)
                    <div class="table-responsive">
                        <table class="table table-curved table-color">
                            <theader>
                                <tr class="align-rule">
                                    <th>Karvės numeris</th>
                                    <th>Karvės veršiavimosi data</th>
                                    <th>Pastebėta ruja</th>
                                    <th>Apsiveršiavimo data</th>
                                    <th>Pastebėjimai</th>
                                </tr>
                            </theader>
                            <tbody>
                            @foreach($heats as $heat)
                                <tr class='clickable-heat-row' id='{{$heat->id}}'>
                                    <td>{{$heat->animal->number}}</td>
                                    <td>{{$heat->calving_date}}</td>
                                    <td>{{$heat->heat_date}}</td>
                                    <td>{{$heat->calving_date_expected}}</td>
                                    <td>{{$heat->notes}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="jumbotron vertical-center">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <h2 class="white-txt">Duomenų nėra...</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
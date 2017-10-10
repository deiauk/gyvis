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
            <button type="button" class="btn btn-success" id="add-heat" data-toggle="modal" data-target="#add-medicine"><i class="fa fa-plus" aria-hidden="true"></i> Pridėti</button>
        @endif
        <button type="submit" class="btn btn-success" id="get-pdf-btn" data-toggle="modal" data-target="#get-pdf"><i class="fa fa-print" aria-hidden="true"></i> Spausdinti</button>
    </div>

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
                    <tr class='clickable-med-row' id='{{$heat->id}}'>
                        <td>{{$heat->number}}</td>
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
@endsection
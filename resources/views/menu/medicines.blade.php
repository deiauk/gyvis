@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    @if(auth()->user()->hasRole('admin'))
        @include('modals.addNewMedical')
        @include('modals.editMedical')
        @include('modals.confirmDelete')
        <div class="row crud-btns">
            <button type="button" class="btn btn-danger disabled" id="delete-medicine"><i class="fa fa-trash" aria-hidden="true"></i> Ištrinti</button>
            <button type="button" class="btn btn-warning disabled" id="edit-medicine"><i class="fa fa-pencil" aria-hidden="true"></i> Redaguoti</button>
            <button type="button" class="btn btn-success" id="add-medicine" data-toggle="modal" data-target="#add-medicine"><i class="fa fa-plus" aria-hidden="true"></i> Pridėti</button>
        </div>
    @endif

    @if(count($medicines) > 0)
        <div class="table-responsive">
            <table class="table table-curved table-color">
                <theader>
                    <tr class="align-rule">
                        <th>Data</th>
                        <th>Pavadinimas</th>
                        <th>Pagaminimo data</th>
                        <th>Galioja</th>
                        <th>Serija</th>
                        <th>Pacientų registracijos nr.</th>
                        <th>Gauta</th>
                        <th>Sunaudota</th>
                        <th>Likutis</th>
                    </tr>
                </theader>
                <tbody>
                    @foreach($medicines as $medicine)
                        @if($medicine->balance <= 0)
                            <tr class='clickable-med-row no-med' id='{{$medicine->medicine_id}}'>
                        @else
                            <tr class='clickable-med-row' id='{{$medicine->medicine_id}}'>
                        @endif
                            <td>{{$medicine->filldate}}</td>
                            <td width="30%">{{$medicine->from}}</td>
                            <td>{{$medicine->productiondate}}</td>
                            <td>{{$medicine->expirydate}}</td>
                            <td>{{$medicine->series}}</td>
                            <td width="12%">{{$medicine->patientregistrationnr}}</td>
                            <td>{{$medicine->quantity}}</td>
                            <td>{{$medicine->consumed}}</td>
                            <td>{{$medicine->balance}}</td>
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
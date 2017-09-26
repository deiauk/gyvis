@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    @include('modals.pdfDateRange')
    <div class="row crud-btns">
        @if(auth()->user()->hasRole('admin'))
        {{--<button type="button" class="btn btn-danger disabled" id="delete" data-toggle="modal" data-target="#confirm-delete">Ištrinti</button>--}}
        <button type="button" class="btn btn-danger disabled" id="delete"><i class="fa fa-trash" aria-hidden="true"></i> Ištrinti</button>
        <button type="button" class="btn btn-warning disabled" id="edit"><i class="fa fa-pencil" aria-hidden="true"></i> Redaguoti</button>
        <button type="button" class="btn btn-info disabled" id="cure"><i class="fa fa-medkit" aria-hidden="true"></i> Gydyti</button>
        <button type="button" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#add-animal"><i class="fa fa-plus" aria-hidden="true"></i> Įvesti naują</button>
        @endif
        <button type="submit" class="btn btn-success" id="get-pdf" data-toggle="modal" data-target="#get-pdf"><i class="fa fa-print" aria-hidden="true"></i> Spausdinti</button>
    </div>


    @if(count($animals) > 0)
        <div class="table-responsive">
            <table class="table table-curved table-color">
                <theader>
                    <tr class="align-rule">
                        <th>Data</th>
                        <th>Numerėlis</th>
                        <th>Vardas</th>
                        <th>Gyvis</th>
                        <th>Veislės vardas</th>
                        <th>Lytis</th>
                        <th>Spava</th>
                        <th>Gimtadienis</th>
                        <th>Mama</th>
                        <th>Tėtis</th>
                        <th>Komentaras</th>
                    </tr>
                </theader>
                <tbody>
                    @foreach($animals as $animal)
                        <tr class='clickable-row' id='{{$animal->id}}'>
                            <td>{{$animal->filldate}}</td>
                            <td>{{$animal->number}}</td>
                            <td>{{$animal->name}}</td>
                            <td>{{$animal->liveBeing}}</td>
                            <td>{{$animal->breedName}}</td>
                            @if($animal->sex == 2)
                                <td>Moteris</td>
                            @elseif($animal->sex == 1)
                                <td>Vyras</td>
                            @else
                                <td>-</td>
                            @endif

                            <td>{{$animal->color}}</td>
                            <td>{{$animal->birthday}}</td>
                            <td>{{$animal->mother}}</td>
                            <td>{{$animal->father}}</td>
                            <td class="fullinfo" data-comment="{{$animal->comment}}">
                                <a>
                                    {{ str_limit($animal->comment, $limit = 20, $end = '...') }}
                                </a>
                            </td>
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

    @if(auth()->user()->hasRole('admin'))
        @include('modals.addNewAnimal')
        @include('modals.confirmDelete')
        @include('modals.editAnimal')
        @include('modals.addNewTreatment')
        @include('modals.showFullValue')
    @endif
@endsection


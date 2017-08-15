@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@stop

@section('content')
    <div class="row crud-btns">
        {{--<button type="button" class="btn btn-danger disabled" id="delete" data-toggle="modal" data-target="#confirm-delete">Ištrinti</button>--}}
        <button type="button" class="btn btn-danger disabled" id="delete">Ištrinti</button>
        <button type="button" class="btn btn-warning disabled" id="edit">Redaguoti</button>
        <button type="button" class="btn btn-info disabled" id="cure">Gydyti</button>
        <button type="button" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#add-animal">Įvesti naują</button>
    </div>

    @if(count($animals) > 0)
        <div class="table-responsive">
            <table class="table table-curved table-color">
                <thead>
                    <tr>
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
                </thead>
                <tbody>
                    @foreach($animals as $animal)
                        <tr class='clickable-row' id='{{$animal->id}}'>
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
                            <td>
                                <a href="#child4">
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

    @include('modals.addNewAnimal')
    @include('modals.confirmDelete')
    @include('modals.editAnimal')
@stop


@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    @if(auth()->user()->hasRole('admin'))

        @include('modals.addNewTreatment')
        @include('modals.editTreatment')
        @include('modals.confirmDelete')
        @include('modals.showFullValue')

        <div class="row crud-btns">
            <button type="button" class="btn btn-danger disabled" id="delete-treatment">Ištrinti</button>
            <button type="button" class="btn btn-warning disabled" id="edit-treatment">Redaguoti</button>
            <button type="button" class="btn btn-success" id="add-treatment" data-toggle="modal" data-target="#add-treatment">Pridėti</button>
        </div>
    @endif

    {{--<div class="table-responsive">--}}
        {{--<table class="table table-curved table-color">--}}
            {{--<theader>--}}
                {{--<tr class="align-rule">--}}
                    {{--<th rowspan="2">Eil. Nr</th>--}}
                    {{--<th rowspan="2">Data</th>--}}
                    {{--<th rowspan="2">Gyvulio Nr.</th>--}}
                    {{--<th colspan="3">GYVULIO</th>--}}
                    {{--<th rowspan="2">Susirgimo data</th>--}}
                    {{--<th colspan="3">Gyvulio tyrimo duomenys</th>--}}
                    {{--<th rowspan="2">Diagnozė</th>--}}
                    {{--<th rowspan="2">Gydymas ir nuordymai</th>--}}
                    {{--<th rowspan="2">Baigtis</th>--}}
                    {{--<th rowspan="2">Pastabos</th>--}}
                {{--</tr>--}}
                {{--<tr class="align-rule">--}}
                    {{--<th>Rūšis</th>--}}
                    {{--<th>Amžius</th>--}}
                    {{--<th>Spalva</th>--}}
                    {{--<th>Temperatūra</th>--}}
                    {{--<th>Pulsas</th>--}}
                    {{--<th>Kvėpavimas</th>--}}
                {{--</tr>--}}
            {{--</theader>--}}
            {{--<tbody>--}}
                {{--<tr class='clickable-row' id='1'>--}}
                    {{--<td>1</td>--}}
                    {{--<td>0.003</td>--}}
                    {{--<td>40%</td>--}}
                    {{--<td>1.9</td>--}}
                    {{--<td>0.003</td>--}}
                    {{--<td>40%</td>--}}
                    {{--<td>1.9</td>--}}
                    {{--<td>0.003</td>--}}
                    {{--<td>40%</td>--}}
                    {{--<td>1.9</td>--}}
                    {{--<td>0.003</td>--}}
                    {{--<td>40%</td>--}}
                    {{--<td>0.003</td>--}}
                    {{--<td>40%</td>--}}
                {{--</tr>--}}

            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}

    @if(count($treatments) > 0)
        <div class="table-responsive">
            <table class="table table-curved table-color">
                <theader>
                    <tr class="align-rule">
                        <th rowspan="2">Eil. Nr</th>
                        <th rowspan="2">Data</th>
                        <th rowspan="2">Gyvulio Nr.</th>
                        <th colspan="3">GYVULIO</th>
                        <th rowspan="2">Susirgimo data</th>
                        <th colspan="3">Gyvulio tyrimo duomenys</th>
                        <th rowspan="2">Diagnozė</th>
                        <th rowspan="2">Gydymas ir nurodymai</th>
                        <th rowspan="2">Vaistai</th>
                        <th rowspan="2">Vaistų kiekis</th>
                        <th rowspan="2">Baigtis</th>
                        <th rowspan="2">Pastabos</th>
                    </tr>
                    <tr class="align-rule">
                        <th>Rūšis</th>
                        <th>Amžius</th>
                        <th>Spalva</th>
                        <th>Temperatūra</th>
                        <th>Pulsas</th>
                        <th>Kvėpavimas</th>
                    </tr>
                </theader>
                <tbody>
                    @php($index = 1)
                    @foreach($treatments as $medicine)
                        <tr class='clickable-treat-row' id='{{$medicine->id}}'>
                            <td>{{$index++}}</td>
                            <td>{{$medicine->date}}</td>
                            <td>{{$medicine->animalNumber}}</td>
                            <td>{{$medicine->animalType}}</td>
                            <td>{{$medicine->age}}</td>
                            <td>{{$medicine->color}}</td>
                            <td>{{$medicine->sickDate}}</td>
                            <td>{{$medicine->animalResearchData}}</td>
                            <td>{{$medicine->pulse}}</td>
                            <td>{{$medicine->breath}}</td>
                            <td>{{$medicine->diagnosis}}</td>
                            <td class="fullinfo" data-comment="{{ $medicine->treatmentAndDirections }}">
                                <a href="#child4">
                                    {{ str_limit($medicine->treatmentAndDirections, $limit = 40, $end = '...') }}
                                </a>
                            </td>
                            <td>{{ $medicine->medicine['from'] }}</td>
                            <td>{{ $medicine->quantity }}</td>
                            <td>{{$medicine->result}}</td>
                            <td class="fullinfo" data-comment="{{$medicine->notes}}">
                                <a>
                                    {{ str_limit($medicine->notes, $limit = 20, $end = '...') }}
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
@endsection
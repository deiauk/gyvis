@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    @if(auth()->user()->hasRole('admin'))
        @include('modals.addNewMedical')
        @include('modals.editMedical')
        @include('modals.confirmDelete')
        @include('modals.add.medicineQuantity')
    @endif
    <div class="row crud-btns">
        @if(auth()->user()->hasRole('admin'))
            <button type="button" class="btn btn-danger disabled" id="delete-medicine"><i class="fa fa-trash" aria-hidden="true"></i> Ištrinti</button>
            <button type="button" class="btn btn-warning disabled" id="edit-medicine"><i class="fa fa-pencil" aria-hidden="true"></i> Redaguoti</button>
            <button type="button" class="btn btn-success" id="add-medicine" data-toggle="modal" data-target="#add-medicine"><i class="fa fa-plus" aria-hidden="true"></i> Pridėti</button>
            <button type="button" class="btn btn-success disabled" id="med-quantity"><i class="fa fa-plus" aria-hidden="true"></i> Pridėti kiekį</button>
        @endif
            <button type="submit" class="btn btn-success" id="get-pdf-btn" {{ is_null($medicine) ? "disabled=disabled" : "" }}><i class="fa fa-print" aria-hidden="true"></i> Spausdinti</button>
            @if(!is_null($medicine))
                <form id="med-form" style="display: none" method="post" target="_blank" action="{{ isset($category) ? route('pdf.create', ["route" => Route::currentRouteName(), "category" => $category]) : route('pdf.create', ["route" => Route::currentRouteName()]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="med" value="{{ $medicine->medicine_id }}">
                </form>
            @endif
    </div>

    <div class="row">
        <div class="col-lg-4">
            <form action="{{ route('medicine.search', ['category' => $category]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="row row-search">
                        <div class="col-sm-8 no-padding-right">
                            <input type="text" class="form-control" name="search" id="search-medicine" value="">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success">Ieškoti</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="created-med">
        <h2>Sukurtas medikamentas</h2>
        <div id="med-table-ajax" class="table-responsive">
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
                    <tr class='clickable-med-row' id=''>
                        <td class="filldate"></td>
                        <td width="30%" class="from"></td>
                        <td class="productiondate"></td>
                        <td class="expirydate"></td>
                        <td class="series"></td>
                        <td width="12%" class="patientregistrationnr"></td>
                        <td class="quantity"></td>
                        <td class="consumed"></td>
                        <td class="balance"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if(!is_null($medicine))
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

    @if(count($logs) > 0)
        <div class="table-responsive">
            <table class="table table-curved table-color">
                <theader>
                    <tr class="align-rule">
                        <th>Vaistas</th>
                        <th>Pacientų registracijos nr.</th>
                        <th>Kiekis</th>
                        <th>Sunaudota</th>
                        <th>Likutis</th>
                    </tr>
                </theader>
                <tbody>
                @foreach($logs as $log)
                    <tr class="{{ $log->type == 2 ? "row-green" : "" }}">
                        <td width="30%">{{ $log->medicine->from }}</td>
                        <td>{{ $log->registration_num > -1 ? $log->registration_num : "Pridedamas kiekis" }}</td>
                        <td>{{ $log->quantity }}</td>
                        <td>{{ $log->used > 0 ? "+" : "" }}{{ $log->used }}</td>
                        <td>{{ $log->quantity + $log->used }}</td>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#search-medicine').autocomplete({
                source: '/medikamentai/autocomplete/{{ $category }}',
                minLength: 0,
                select: function (event, ui) {
                    $('#search-medicine').val(ui.item.value);
                }
            })
            .focus(function() {
                $(this).autocomplete('search', $(this).val())
            });
            $('#get-pdf-btn').on('click', function () {
                $('#med-form').submit();
            });
        });
    </script>
@endsection
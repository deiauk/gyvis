@extends('welcome')

@section('navbar')
    @include('navbar.navbarview')
@endsection

@section('content')
    @include('modals.pdfDateRange')
    @include('modals.showFullValue')

    <div class="row crud-btns">
        <div class="col-lg-4 no-padding-left">
            <form action="{{ route('heat.calving.search') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="row row-search">
                        <div class="col-sm-8 no-padding-right">
                            <input type="number" min="1990" class="form-control" name="search" id="search" value="{{ $search }}">
                        </div>
                        @if($errors->has('search'))
                            <span class="help-block err-file">
                                    <strong>
                                        {{ $errors->first('search') }}
                                    </strong>
                                </span>
                        @endif
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success">Ieškoti</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <button type="submit" class="btn btn-success" id="get-pdf-btn" data-toggle="modal" data-target="#get-pdf"><i class="fa fa-print" aria-hidden="true"></i> Spausdinti</button>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2 id="calving-year">
                {{ empty($search) ? date('Y') : $search }} metai
            </h2>
            @if(!empty($months))
                @if(count($months) > 0)
                    @foreach($months as $month => $heats)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ GeneralHelper::getMonth($month) }}
                            </div>
                            <div class="panel-body">
                                @if(count($heats) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-curved table-color">
                                            <theader>
                                                <tr class="align-rule">
                                                    <th>Karvės numeris</th>
                                                    <th>Data</th>
                                                    <th>Pastebėjimai</th>
                                                </tr>
                                            </theader>
                                            <tbody>
                                            @foreach($heats as $item)
                                                <tr>
                                                    <td>{{ !empty($item->animal) ? $item->animal->number : '' }}</td>
                                                    <td>{{$item->calving_date_expected}}</td>
                                                    <td class="fullinfo" data-comment="{{$item->notes}}">
                                                        <a>
                                                            {{ str_limit($item->notes, 20, '...') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    Nėra duomenų...
                                @endif
                            </div>
                        </div>
                    @endforeach
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
@extends('welcome')

@section('navbar')
    @if(auth()->check())
        @include('navbar.navbarview')
    @endif
@endsection

@section('content')

    @if(auth()->check() && auth()->user()->hasRole('admin'))
        @include('modals.confirmDelete')
    @endif

    <div class="row crud-btns">
        @if(auth()->check() && auth()->user()->hasRole('admin'))
            <button type="button" class="btn btn-danger disabled" id="gallery-delete"><i class="fa fa-trash" aria-hidden="true"></i> Ištrinti</button>
            <button type="button" class="btn btn-success" id="gallery-upload" data-toggle="modal" data-target="#gallery-upload"><i class="fa fa-upload" aria-hidden="true"></i> Įkelti nuotrauką</button>
        @endif
    </div>

    @php($i = 0)
    @if(!empty($galleries))
        @foreach($galleries as $gallery)
            @if($i == 0)<div class="row">@endif

            <div class="col-lg-3">
                <img class="gallery-img" src="{{ asset('uploads/gallery/' . $gallery->filename) }}">
                @if(auth()->check() && auth()->user()->hasRole('admin'))
                    <a class="gallery-delete" data-id="{{ $gallery->id }}" href="#">Ištrinti</a>
                @endif
            </div>
            @if($i == 3)</div>@endif

            @if($i >= 3)
                @php($i = 0)
            @else
                @php($i++)
            @endif

        @endforeach
    @endif

@endsection
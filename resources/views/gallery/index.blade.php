@extends('welcome')

@section('navbar')
    @if(auth()->check())
        @include('navbar.navbarview')
    @else
        @include('navbar.navbarview-guest')
    @endif
@endsection

@section('content')

    @if(auth()->check() && auth()->user()->hasRole('admin'))
        @include('modals.gallery.upload')
        @include('modals.confirmDelete')
    @endif

    <div class="row crud-btns">
        @if(auth()->check() && auth()->user()->hasRole('admin'))
            <button type="button" class="btn btn-success" id="gallery-upload" data-toggle="modal" data-target="#gallery-upload"><i class="fa fa-upload" aria-hidden="true"></i> Įkelti nuotrauką</button>
        @endif
    </div>

    @php($i = 0)
    @if(!empty($galleries))
        @foreach($galleries as $gallery)
            @if($i == 0)<div class="row">@endif

            <div class="col-lg-3">
                <a data-lightbox="lightbox" href="{{ asset('uploads/gallery/' . $gallery->filename) }}">
                    <div class="gallery-bg" style="background-image: url('{{ asset('uploads/gallery/' . $gallery->filename) }}')"></div>
                    {{--<img class="gallery-img" src="{{ asset('uploads/gallery/' . $gallery->filename) }}">--}}
                </a>
                @if(auth()->check() && auth()->user()->hasRole('admin'))
                    <a class="gallery-delete" data-id="{{ $gallery->id }}">Ištrinti</a>
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
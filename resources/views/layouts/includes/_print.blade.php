<form id="pdf-form" target="_blank" action="@if(isset($category))
        {{ route('pdf.create', ["route" => Route::currentRouteName(), "category" => $category]) }}
    @else
        {{ route('pdf.create', ["route" => Route::currentRouteName()]) }}
    @endif">
    <button type="submit" class="btn btn-success" id="get-pdf">
        <i class="fa fa-print" aria-hidden="true"></i> Spausdinti
    </button>
</form>
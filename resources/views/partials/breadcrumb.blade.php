@if(!empty($breadcrumbs) && count($breadcrumbs) > 1)
    <span>
        @foreach($breadcrumbs as $breadcrumb)
            <a href="{{ $breadcrumb['uri'] }}">{{ $breadcrumb['text'] }}</a> >
        @endforeach
    </span>
@endif
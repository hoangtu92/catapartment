@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(Setting::get("banner_page")) }}" alt=""/>
    </section>

    <section class="page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $page->title }}</h2>
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </section>

@endsection

@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")
    <section class="inner-banner">
        <img src="images/catshop-banner07.jpg" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ptop">
                        <h5><strong>對貓公寓有什麼建議，歡迎留言詢問！</strong></h5>
                    </div>
                </div>
            </div>
            <div class="row faq-page">
                <div class="col-lg-6">
                    <h3>Shopping Information</h3>
                    <ul class="faq">
                        @foreach($shopping_faqs as $item)
                        <li class="q"><img src="images/arrow.png">{{ $item->question }}</li>
                        <li class="a">{!! $item->answer !!}
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-6">
                    <h3>Payment Information</h3>
                    <ul class="faq">
                        @foreach($payment_faqs as $item)
                            <li class="q"><img src="images/arrow.png">{{ $item->question }}</li>
                            <li class="a">{!! $item->answer !!}
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection


@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>
@endsection

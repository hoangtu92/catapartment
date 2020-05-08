@extends("frontend.templates.default")

@section("content")
    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_faq")) }}" alt=""/>
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
                    <h3>{{ __("Shopping Information") }}</h3>
                    <ul class="faq">
                        @foreach($shopping_faqs as $item)
                        <li class="q"><img src="images/arrow.png">{{ $item->question }}</li>
                        <li class="a">{!! $item->answer !!}
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-6">
                    <h3>{{ __("Payment Information") }}</h3>
                    <ul class="faq">
                        @foreach($payment_faqs as $item)
                            <li class="q"><img src="images/arrow.png">{{ $item->question }}</li>
                            <li class="a">{!! $item->answer !!}
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
            <div class="row faq-page">
                <div class="col-lg-6">
                    <h3>{{ __("Membership Information") }}</h3>
                    <ul class="faq">
                        @foreach($membership_faq as $item)
                            <li class="q"><img src="images/arrow.png">{{ $item->question }}</li>
                            <li class="a">{!! $item->answer !!}
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-6">
                    <h3><a href="{{ route("contact") }}">需要客服</a></h3>
                </div>
            </div>
        </div>
    </section>
@endsection


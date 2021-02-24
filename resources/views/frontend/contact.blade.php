@extends("frontend.templates.default")

@section("content")
<section class="inner-banner">
    <img src="{{ asset("images/catshop-banner06.jpg") }}" alt=""/>
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

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route("contact_post") }}" method="post" class="form-part" id="protectedForm">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                    @csrf
                    <input type="hidden" name="action" value="contact">
                    <input type="hidden" name="_g_token" id="token">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __("Your Name") }}</label>
                                <input type="text" name="customer_name" class="form-control" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{ __("Your Email") }}</label>
                                <input type="email" name="customer_email" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel">{{ __("Phone Number") }}</label>
                                <input type="tel" name="customer_phone" class="form-control" id="tel">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="free_time">{{ __("Free Time") }}</label>
                                <input type="text" name="customer_free_time" class="form-control" id="free_time">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="free_time">{{ __("主旨") }}</label>
                                <input type="text" name="customer_subject" class="form-control" id="customer_subject">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">{{ __("Customer Message") }}</label>
                                <textarea name="customer_message" id="message" cols="" rows="" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button data-sitekey="{{ env("g_site_key") }}"
                                        data-callback='onSubmit'
                                        data-action='submit' class="g-recaptcha btn-cat">{{ __("Ask a question") }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

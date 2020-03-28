@extends('frontend.templates.default')

@section('content')
    <section class="inner-banner">
        <img src="{{ asset("images/catshop-banner08.jpg") }}" alt=""/>
    </section>
    <section class="mt-4 mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-center">{{ __('Verify Your Email Address') }}</h2>
                    <div class="">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                             | <a href="#" class="logout-link">{{ __("Logout") }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

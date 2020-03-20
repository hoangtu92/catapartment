<section class="prodect-landing-slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="pl-slider" class="owl-carousel">
                    @foreach($advertisements as $ads)
                        <div class="item" data-aos="fade-up">
                            <a href="{{ $ads->url }}">
                                <img src="{{ asset($ads->image) }}" alt="ads">
                            </a>
                            {{--<div class="row">
                                <div class="col-lg-6"><img src="{{ asset("images/chair-img.jpg") }}" alt=""/></div>
                                <div class="col-lg-6">
                                    <div class="product-d"><span>Product Landing Page</span>
                                        <h3>Vitra Chair Classic Design</h3>
                                        <table class="table full-width">
                                            <tbody>
                                            <tr>
                                                <th>Designer</th>
                                                <th>Materials</th>
                                                <th>Client</th>
                                            </tr>
                                            <tr>
                                                <td>Charles</td>
                                                <td>Wood, Leather</td>
                                                <td>Woodmart</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <h4>$1999.00</h4>
                                        <a href="#">Add to Cart</a></div>
                                </div>
                            </div>--}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

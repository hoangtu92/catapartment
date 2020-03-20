@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
    @endsection

@section("content")
<section class="inner-banner">
    <img src="{{ asset("images/catshop-banner15.jpg") }}" alt=""/>
</section>

<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-box">
                    <h5>Design Trends, Furniture</h5>
                    <h2>Seating Collections Inspiration</h2>
                    <div class="img-box"><span><em>23</em> JUL</span><img src="{{ asset("images/blog-detial-image.jpg") }}" alt="">
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting.</p>


                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-detail-right">
                    <h3>Tags</h3>
                    <div class="bcategories">
                        <a href="#">Decoration</a>, <a href="#">Design trends</a>, <a href="#">Furniture</a>, <a
                            href="#">Hand made</a>, <a href="#">Inspiration</a>, <a href="#">Wooden accessories</a>
                    </div>
                    <hr>
                    <h3>Recent Post</h3>
                    <div class="re-post"><a href="#"><img src="{{ asset("images/blog-right1.jpg") }}" alt=""/></a>
                        <a href="#"><h4>A companion for extra sleeping</h4></a>
                        <p>July 23, 2019 <strong></strong></p>
                    </div>
                    <div class="re-post"><a href="#"><img src="{{ asset("images/blog-right2.jpg") }}" alt=""/></a>
                        <a href="#"><h4>A companion for extra sleeping</h4></a>
                        <p>July 23, 2019 <strong></strong></p>
                    </div>
                    <div class="re-post"><a href="#"><img src="{{ asset("images/blog-right3.jpg") }}" alt=""/></a>
                        <a href="#"><h4>A companion for extra sleeping</h4></a>
                        <p>July 23, 2019 <strong></strong></p>
                    </div>
                    <div class="re-post"><a href="#"><img src="{{ asset("images/blog-right4.jpg") }}" alt=""/></a>
                        <a href="#"><h4>A companion for extra sleeping</h4></a>
                        <p>July 23, 2019 <strong></strong></p>
                    </div>
                    <div class="re-post"><a href="#"><img src="{{ asset("images/blog-right5.jpg") }}" alt=""/></a>
                        <a href="#"><h4>A companion for extra sleeping</h4></a>
                        <p>July 23, 2019 <strong></strong></p>
                    </div>

                    <h3 class="mt-3">Our Instagram</h3>
                    <ul class="insta">
                        <li><img src="{{ asset("images/insta-img01.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img02.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img03.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img01.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img02.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img03.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img01.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img02.jpg") }}" alt=""/></li>
                        <li><img src="{{ asset("images/insta-img03.jpg") }}" alt=""/></li>
                    </ul>
                    <h5><a href="https://www.instagram.com/catsapartment_puzzle/" target="blank"><img
                                src="{{ asset("images/instagram-icon.png") }}" alt=""/> View Profile</a></h5>

                </div>

            </div>
        </div>
    </div>
</section>

@include("frontend.global.ads")

@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/price_range_script.js" type="text/javascript"></script>

    <!-- Product Count JS Part Start -->
    <script>

        $('.btn-number').click(function(e){
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {

                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
    @endsection

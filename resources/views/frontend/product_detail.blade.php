@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
    @endsection

@section("content")

    <section class="detail-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <div class="bread"><a href="#">首頁</a> / <a href="#">拼圖商店</a> / <span>歐美小公主拼圖1,000片</span></div>
                    <h1>歐美小公主拼圖1,000片</h1>
                    <p class="cre"><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/> ( 1 customer review )</p>
                    <h3 class="price"><span>$780.00</span> $555.00</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    <div class="color-div">
                        <span>Color : </span><a href="#" class="black-bg"></a> <a href="#" class="red-bg"></a> <a href="#" class="yellow-bg"></a>
                    </div>
                    <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                  <span>-</span>
              </button>
          </span>
                        <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                        <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                  <span>+</span>
              </button>
          </span>
                    </div>
                    <a href="#" class="addto">Add to cart</a>
                    <div class="add-wishlist"><a href="#"><img src="{{ asset("images/icon02.jpg") }}" alt=""/> Add to Wishlist</a></div>
                    <hr>
                    <h4><strong>SKU :</strong> N/A</h4>
                    <h4><strong>Catetory :</strong> Clocks</h4>
                    <h4><strong>Share : <a href="#"><img src="{{ asset("images/facebook-icon.png") }}" width="25" alt=""/></a> <a href="#"><img src="{{ asset("images/twitter-icon.png") }}" width="30" alt=""/></a></strong> </h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div id="horizontalTab">
                        <ul class="resp-tabs-list">
                            <li>Description</li>
                            <li>Additional Information</li>
                            <li>Review</li>
                            <li>About Brand</li>
                            <li>Shipping & Devivery</li>
                        </ul>
                        <div class="resp-tabs-container">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p> 玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。</p>

                                        <p>此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。</p>

                                        <p>拼圖背後的小手 將整個臺灣串聯</p>

                                        <p>「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。</p>

                                        <p>臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-tb">
                                            <table class="table full-width" style="max-width:500px; margin:auto;">
                                                <tbody>
                                                <tr>
                                                    <td><b>Brand</b></td>
                                                    <td>Joseph</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Color</b></td>
                                                    <td>Black</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Measures</b></td>
                                                    <td>35 cm</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Origin</b></td>
                                                    <td>Spain</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>1 Review for best clock parallels</h3>
                                        <div class="re-box">
                                            <img src="{{ asset("images/user-img.jpg") }}" alt=""/>
                                            <h4><b>Donald Holmes</b> - July 28,2017</h4><span><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/></span>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="mb-3">Add a Review</h3>
                                        <p>Your email address will not be published. Required fields are marked*</p>
                                        <p class="rating"><strong>Your Rating :</strong> <img src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img src="{{ asset("images/star-icon02.jpg") }}" alt=""/></p>

                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Your Review <em>*</em></label>
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <em>*</em></label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email <em>*</em></label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="checkbox-btn">Save my name, email, and website in this browser for the next time i comment.
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn02">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <hr>
                                        <p>Lorem Ipsum is <strong>simply dummy text</strong> of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="{{ asset("images/product01.jpg") }}" alt=""/></div>
                                            <div class="col-lg-4"><img src="{{ asset("images/product02.jpg") }}" alt=""/></div>
                                            <div class="col-lg-4"><img src="{{ asset("images/product03.jpg") }}" alt=""/></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset("images/shipping-img.jpg") }}" alt=""/> </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-2">Maecenas Iaculis</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <h3 class="mb-2 mt-3">Adipiscing convallis bulum</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <p>Lorem Ipsum is simply dummy text of the printing. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid recently-viewed">
        <div class="row">
            <div class="col-lg-12">
                <h2>最近看過的商品</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 guide-slider">
                <div id="rv-slider" class="owl-carousel">
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a> </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a> </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a> </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a> </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a> </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

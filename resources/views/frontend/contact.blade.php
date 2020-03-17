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
                <form action="" class="form-part">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Your Name</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Your E-mail</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Phone Number</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Free Time</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Message</label>
                                <textarea name="" cols="" rows="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-default">Ask a question</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

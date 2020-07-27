<div class="blog-detail-right">
    {{--<h3>Tags</h3>
    <div class="bcategories">
        @foreach($tags as $index => $tag)
        <a href="{{ route("news_tag", ["tagName" => $tag->name]) }}">{{ $tag->name }}</a>
            @if($index < count($tags) - 1),@endif
        @endforeach
    </div>
    <hr>--}}
    <h3>Recent Post</h3>
    @foreach($recentNews as $item)
    <div class="re-post"><a href="{{ route("news_details", ["slug" => $item->title]) }}"><img src="{{ asset($item->image) }}" alt=""/></a>
        <a href="{{ route("news_details", ["slug" => $item->title]) }}"><h4>{{ $item->title }}</h4></a>
        <p>{{ $item->created_at->format("F j, Y") }} <strong></strong></p>
    </div>
    @endforeach


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

<div class="header-top">
    <div class="container">
        <div class="top-left" style="display: flex; flex-direction: row; align-items: center; width: calc(100% - 360px)">
            <span class="upClick">Cats Apartment 貓公寓拼圖坊</span>
            <span class="announcements" style="width: calc(100% - 235px);">
                <span>
                    @foreach($announcements as $announcement)
                        <a target="_blank" data-timeout="{{ $announcement->timing }}" href="{{ $announcement->url }}">{{ $announcement->content }}</a>
                    @endforeach
                </span>
            </span>

        </div>
        <div class="top-right">
            <span class="top-soial">
                <a href="mailto:{{ Setting::get("contact_email") }}"><img
                        src="{{ asset("images/mail-icon.png") }}" alt=""/></a>
                <a href="https://www.facebook.com/Catsapartmentblog/"
                                                          target="blank"><img
                        src="{{ asset("images/facebook-icon.png") }}" alt=""/></a>
                <a href="https://id.pinterest.com/catsapaerment/?eq=%E8%B2%93%E5%85%AC%E5%AF%93&etslf=3030"
                    target="blank"><img src="{{ asset("images/pinterest_icon.png") }}" alt=""/></a>
                <a href="https://www.instagram.com/catsapartment_puzzle/" target="blank"><img
                        src="{{ asset("images/instagram-icon.png") }}" alt=""/></a>
            </span>
            <span><a href="{{ route("contact") }}">聯絡我們<span class="en-title">Contact Us</span> </a></span> <span><a href="{{ route("faq") }}">{{ __("FAQ") }}<span class="en-title">FAQ</span></a></span></div>
    </div>
</div>

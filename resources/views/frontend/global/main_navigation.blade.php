<div class="stellarnav">
    <ul>
        <li><a href="{{ route("home") }}" class="active">貓公寓首頁 </a>
        </li>
        <li><a href="">拼圖商店 <span class="en-title">Puzzle Shop</span></a>
            <ul>
                <li><a href="{{ route("products", ["sort" => "latest"]) }}">最新商品</a> </li>
                <li><a href="{{ route("products", ["sort" => "populated"]) }}">熱門暢銷</a> </li>
                <li><a href="#">補貨上架拼圖
                    </a>
                <ul>
                    @foreach($sub_menu as $item)
                        <li><a href="{{ route("products") }}?f={{ $item->date }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
                </li>

            </ul>
        </li>
        <li><a href="{{ route("customized_products") }}">裱框服務<span class="en-title">Framed Service</span></a>

        </li>
        <li><a href="{{ route("news") }}">拼圖情報<span class="en-title">Puzzle News</span></a>

        </li>
        <li><a href="{{ route("pre_order_products") }}">海外預購<span class="en-title">Pre-order</span> </a>
        </li>
    </ul>
</div>

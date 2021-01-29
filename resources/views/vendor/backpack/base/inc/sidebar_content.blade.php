<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-tachometer-alt nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-file-archive"></i> <span>檔案總管</span></a></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-home"></i> {{ trans('backpack::site.home_management') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('slide') }}'><i class='nav-icon fa fa-images'></i> {{ trans('backpack::site.slides') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('latest-product') }}'><i class='nav-icon fa fa-gift'></i> {{ trans('backpack::site.home_latest_puzzle') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('recommend-product') }}'><i class='nav-icon fa fa-gift'></i> {{ trans('backpack::site.home_recommend_puzzle') }}</a></li>
    </ul>
</li>

<li class='nav-item'><hr></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-users"></i> {{ trans('backpack::site.user_menu') }}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="fa fa-users nav-icon"></i> {{ trans('backpack::site.user_manager') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user-point') }}'><i class='nav-icon fa fa-chart-bar'></i>{{ trans("backpack::site.user_point") }}</a></li>
    </ul>
</li>

<li class='nav-item'><hr></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-shopping-cart"></i> {{ trans('backpack::site.orders') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('order') }}'><i class='nav-icon fa fa-shopping-cart'></i> {{ trans('backpack::site.orders') }}</a></li>
{{--
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transaction') }}'><i class='nav-icon fa fa-bank'></i>{{ trans('backpack::site.transactions') }}</a></li>
--}}
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('shipping-method') }}'><i class='nav-icon fa fa-truck'></i> {{ trans('backpack::site.shipping_method') }}</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-gift"></i> {{ trans('backpack::site.products') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon fa fa-gift'></i> 產品編輯</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('inventory') }}'><i class='nav-icon fa fa-archive'></i> 庫存警示<sup>{{ \App\Models\Product::where("stock", 0)->orWHere("status", PRE_ORDER)->count() }}</sup></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('stock-notify') }}'><i class='nav-icon la la-rss'></i> 補貨通知名單</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product-category') }}'><i class='nav-icon fa fa-tag'></i>{{ trans('backpack::site.product_categories_submenu') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('color') }}'><i class='nav-icon fa fa-paint-brush'></i> 材質
            </a></li>

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('material') }}'><i class='nav-icon fa fa-paint-brush'></i> 效果
            </a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('brand') }}'><i class='nav-icon fa fa-building'></i> {{ trans('backpack::site.brand_menu') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('origin') }}'><i class='nav-icon fa fa-globe'></i> {{ trans('backpack::site.product_origin') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('piece') }}'><i class='nav-icon fa fa-puzzle-piece'></i> {{ trans('backpack::site.product_pieces') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frame') }}'><i class='nav-icon fa fa-image'></i> 框的材質</a></li>
    </ul>
</li>

<li class='nav-item'><hr></li>



<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper"></i> {{ trans('backpack::site.news') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('news') }}'><i class='nav-icon fa fa-newspaper'></i> {{ trans('backpack::site.news_submenu') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('news-tag') }}'><i class='nav-icon fa fa-tags'></i> {{ trans('backpack::site.news_tags_submenu') }}</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('faq') }}'><i class='nav-icon fa fa-question'></i> {{ trans('backpack::site.faqs') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('announcement') }}'><i class='nav-icon fa fa-rss-square'></i> {{ trans('backpack::site.announcements') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('newsletter') }}'><i class='nav-icon fa fa-envelope'></i> {{ trans('backpack::site.newsletter') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('advertisement') }}'><i class='nav-icon fa fa-external-link-square-alt'></i> {{ trans('backpack::site.advertisements') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('message') }}'><i class='nav-icon fa fa-question-circle'></i> {{ trans("backpack::site.contact_message") }}</a></li>

<li class='nav-item'><hr></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon fa fa-cog'></i> <span>{{ trans("backpack::site.settings") }}</span></a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('submenu') }}'><i class='nav-icon fa fa-sitemap'></i> {{ trans("backpack::site.submenu") }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon fa fa-link'></i> {{ trans("backpack::site.page") }}</a></li>

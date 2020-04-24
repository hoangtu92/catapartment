<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="fa fa-users nav-icon"></i> {{ trans('backpack::site.user_manager') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('transaction') }}'><i class='nav-icon fa fa-bank'></i>{{ trans('backpack::site.transactions') }}</a></li>
--}}
{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('order') }}'><i class='nav-icon fa fa-bar-chart'></i> {{ trans('backpack::site.orders') }}</a></li>
--}}

<li class='nav-item'></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-home"></i> {{ trans('backpack::site.home_management') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('slide') }}'><i class='nav-icon fa fa-picture-o'></i> {{ trans('backpack::site.slides') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('latest-product') }}'><i class='nav-icon fa fa-puzzle-piece'></i> {{ trans('backpack::site.home_latest_puzzle') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('recommend-product') }}'><i class='nav-icon fa fa-puzzle-piece'></i> {{ trans('backpack::site.home_recommend_puzzle') }}</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i> {{ trans('backpack::site.news') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('news') }}'><i class='nav-icon fa fa-newspaper-o'></i> {{ trans('backpack::site.news') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('news-tag') }}'><i class='nav-icon fa fa-tags'></i> {{ trans('backpack::site.news_tags') }}</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-shopping-cart"></i> {{ trans('backpack::site.products') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon fa fa-shopping-cart'></i> {{ trans('backpack::site.products') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product-category') }}'><i class='nav-icon fa fa-tag'></i>{{ trans('backpack::site.product_categories') }}</a></li>
    </ul>
</li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('faq') }}'><i class='nav-icon fa fa-question'></i> {{ trans('backpack::site.faqs') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('announcement') }}'><i class='nav-icon fa fa-rss-square'></i> {{ trans('backpack::site.announcements') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('newsletter') }}'><i class='nav-icon fa fa-envelope-o'></i> {{ trans('backpack::site.newsletter') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('advertisement') }}'><i class='nav-icon fa fa-external-link-square'></i> {{ trans('backpack::site.advertisements') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('message') }}'><i class='nav-icon fa fa-question-circle'></i> {{ trans("backpack::site.contact_message") }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon fa fa-cog'></i> <span>{{ trans("backpack::site.settings") }}</span></a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('submenu') }}'><i class='nav-icon fa fa-sitemap'></i> {{ trans("backpack::site.submenu") }}</a></li>

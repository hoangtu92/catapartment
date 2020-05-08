<div class="col-md-3">
    <div class="lbox">
        <h3>用價格找拼圖</h3>
        <div class="price-range-block">
            <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
            <div style="margin:20px auto">
                <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');"
                       id="min_price" class="price-range-field"/>
                <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');"
                       id="max_price" class="price-range-field"/>
            </div>
            <button class="price-range-search" id="price-range-submit"
                    style="display:block !important;">Search
            </button>

        </div>
    </div>
    <div class="lbox">
        <h3>用產地找拼圖</h3>
        <ul>
            <li><a href="#"><img src="{{ asset("images/country-icon01.png") }}" alt=""/> 日本 <span>10</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon02.png") }}" alt=""/> 美國 <span>12</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon03.png") }}" alt=""/> 英國 <span>14</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon04.png") }}" alt=""/> 德國 <span>10</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon05.png") }}" alt=""/> 法國 <span>16</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon06.png") }}" alt=""/> 義大利 <span>11</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon07.png") }}" alt=""/> 韓國 <span>18</span></a></li>
            <li><a href="#"><img src="{{ asset("images/country-icon08.png") }}" alt=""/> 台灣 <span>12</span></a></li>
        </ul>
    </div>
    <div class="lbox">
        <h3>用片數找拼圖</h3>
        <ul>
            <li><a href="#">～100 片 <span>10</span></a></li>
            <li><a href="#">101～300 片 <span>12</span></a></li>
            <li><a href="#">301~500 片 <span>14</span></a></li>
            <li><a href="#">501片~800 片 <span>10</span></a></li>
            <li><a href="#">801~1,000 片 <span>16</span></a></li>
            <li><a href="#">1,001~1,200 片 <span>11</span></a></li>
            <li><a href="#">1,201~1,500 片 <span>18</span></a></li>
            <li><a href="#">1,501~2,000 片 <span>12</span></a></li>
            <li><a href="#">2,000片以上 <span>12</span></a></li>
        </ul>
    </div>
    <div class="lbox">
        <h3>用品牌找拼圖</h3>
        <ul class="brands">
            <li><img src="{{ asset("images/brand-logo01.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo06.jpg") }}" alt=""/>
            </li>
            <li><img src="{{ asset("images/brand-logo02.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo07.jpg") }}" alt=""/>
            </li>
            <li><img src="{{ asset("images/brand-logo03.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo08.jpg") }}" alt=""/>
            </li>
            <li><img src="{{ asset("images/brand-logo04.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo09.jpg") }}" alt=""/>
            </li>
            <li><img src="{{ asset("images/brand-logo05.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo10.jpg") }}" alt=""/>
            </li>
        </ul>
    </div>
</div>

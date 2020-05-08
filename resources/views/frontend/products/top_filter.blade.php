<div class="ptop">

    <h5><a href="#">Text 1</a> / <span>Text 2</span></h5>

    <form method="get" action="{{ route("products") }}">
        <div class="ptop-right">
                            <span><strong>Show :</strong>
                                <a href="#">9</a> /
                                <a href="#" class="active">12</a> /
                                <a href="#">18</a> /
                                <a href="#">24</a></span>
            <span><a href="#"><img src="{{ asset("images/licon01.jpg") }}" alt=""/></a> <a href="#"><img
                        src="{{ asset("images/licon02.jpg") }}" alt=""/></a> <a href="#"><img
                        src="{{ asset("images/licon03.jpg") }}"
                        alt=""/></a> <a
                    href="#"><img src="{{ asset("images/licon04.jpg") }}" alt=""/></a></span>
            <span>
<select name="orderBy">
<option value="">{{ __("Default Sorting") }}</option>
<option value="ASC">{{ __("Sorting A to Z") }}</option>
<option value="DESC">{{ __("Sorting Z to A") }}</option>
</select>
</span>

    </form>
</div>

</div>

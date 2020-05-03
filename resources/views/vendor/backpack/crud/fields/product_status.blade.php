<!-- enum -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    @php
        $entity_model = $crud->model;
        $possible_values = $entity_model::getPossibleEnumValues($field['name']);
    @endphp
    <select id="{{ $field['id'] }}"
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes')
    >

        @if ($entity_model::isColumnNullable($field['name']))
            <option value="">-</option>
        @endif

        @if (count($possible_values))
            @foreach ($possible_values as $possible_value)
                <option value="{{ $possible_value }}"
                        @if (( old(square_brackets_to_dots($field['name'])) &&  old(square_brackets_to_dots($field['name'])) == $possible_value) || (isset($field['value']) && $field['value']==$possible_value))
                        selected
                    @endif
                >{{ $possible_value }}</option>
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

<script>



    function checkType(value){
        if(value === "{{IN_STOCK}}"){
            document.querySelector("#stock_field").style.display = "block";
        }
        else{
            document.querySelector("#stock_field").style.display = "none";
        }
    }
    document.querySelector("#product_status").onchange = function(){
        checkType(this.value)
    };
    window.onload = function () {
        if(document.querySelector("#product_status")){
            checkType(document.querySelector("#product_status").value)
        }

    }
</script>

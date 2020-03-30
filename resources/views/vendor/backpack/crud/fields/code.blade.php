<style>
    #editor {
        width: 100%;
        height: 400px;
    }
</style>
<div class="form-group col-md-12 ads_code" >
    <div id="editor">{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</div>
</div>

<textarea style="display: none;"
          name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes')

>{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</textarea>

<script src="{{ url('vendor/ace-min') }}/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('vendor/ace-min') }}/mode-html_elixir.js" type="text/javascript" charset="utf-8"></script>
<script>

    var editor = ace.edit('editor');
    var textarea = document.querySelector('textarea[name="code"]');
    editor.getSession().on("change", function () {
        textarea.value = editor.getSession().getValue();
    });

    var HTMLMode = ace.require("ace/mode/html_elixir").Mode;
    editor.session.setMode(new HTMLMode());

</script>

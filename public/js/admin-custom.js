jQuery(document).ready(function ($) {

    function checkDisplay(value){
        if(value){
            $("#valid_from").hide();
            $("#valid_until").hide();
        }
        else{
            $("#valid_from").show();
            $("#valid_until").show();
        }
    }

    $("#display_checkbox").change(function (e) {
        checkDisplay(this.checked)
    });

    if(document.querySelector("#display_checkbox")){
        checkDisplay(document.querySelector("#display_checkbox").checked)
    }


});

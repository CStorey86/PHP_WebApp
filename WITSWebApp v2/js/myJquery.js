
$(document).ready(function(){

    //when online/not online radio button is selected
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });

    //when venue chosen from select menu
    $(function() {
        $('#locations').change(function(){
            $('.venueOptions').hide();
            $('#' + $(this).val()).show();
        });
    });

});
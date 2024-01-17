
$(document).ready(function() {
    $('#country_select').on('change', checkId);
});

function checkId() {
    // var selected = $('#my_select').val();
    // $.ajax({
    //     url:        '/you/php/script.php',
    //     type:       'POST',
    //     dataType:   'json',
    //     data:       { value: selected },
    //     success:    function(data) {
    //         $('#some_div').html(data);
    //     }
    // });
     var selectedValue = $('#country_select').val();
     console.log(selectedValue);
}


$(document).ready(function() {
    $('#country_select').on('change', checkId);
    $('#program_select').on('change', checkId);
});

function checkId() {
    var countryValue = $('#country_select').val();
     var programValue = $('#program_select').val();

     if (countryValue != 1) {
        $('#kcse-label').hide();
        $('#kcse-input').hide();
    } else {
        $('#kcse-label').show();
        $('#kcse-input').show();
    }

    $.ajax({
        url:        '/mini/casuals/getCasualId',
        type:       'POST',
        dataType:   'json',
        data:        { country: countryValue , program: programValue },
        success:    function(data) {
            console.log(data);
            var maxCasualId = data.max_casual_id;
            $('#casual_id').val(maxCasualId);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.error('AJAX Error:', textStatus, errorThrown);
        console.log('Server Response:', jqXHR.responseText);
    },
    complete: function() {
        console.log('Complete callback reached');
    }
    
    });
}

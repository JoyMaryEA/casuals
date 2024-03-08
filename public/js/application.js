$(document).ready(function() {

  //get the new casual_id
    $('#country_select').on('change', checkId);
    $('#program_select').on('change', checkId);

// do validation on the edit casual form  
    $("#edit-form").submit(function(event) {
      event.preventDefault();
   
      if (validateEditForm($('#country_select').val())) {
          var formData = $(this).serialize();
  
          $.ajax({
              url: '/mini/casuals/editCasual',
              type: 'POST', 
              data: formData,
              dataType: 'html',
            success: function(data) {
                document.open();
                document.write(data);
                document.close();
                console.log("let's get it");
            },
              error: function(jqXHR, textStatus, errorThrown) {
           
                  console.error('AJAX Error:', textStatus, errorThrown);
                  console.log('Server Response:', jqXHR.responseText);
              }
          });
      }
  });
  
 

});


function checkId() {
    
    var countryValue = $('#country_select').val();
    

    if (countryValue != 1) {
       $('#kcse-label').hide();
       $('#kcse-input').hide();
   } else {
       $('#kcse-label').show();
       $('#kcse-input').show();
   }
    var programValue = $('#program_select').val();

    $.ajax({
        url:        '/mini/casuals/getCasualId',
        type:       'POST',
        dataType:   'json',
        data:        { country: countryValue , program: programValue },
        success:    function(data) {
           // console.log(data);
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

      function validateEditForm(country) {
        var firstName = $("#first_name").val();
        var last_name = $("#last_name").val();
        var id_no = $("#id_no").val();
        var phone_no = $("#phone_no").val();
        var alt_phone_no = $("#alt_phone_no").val();
        var year_worked = $("#year_worked").val();
        var duration_worked = $("#duration_worked").val();

      
        $('#required-first-name').text("");
        $('#required-last-name').text("");
        $('#required-id-no').text("");
        $('#required-phone-no').text("");
        $('#required-year-worked').text("");
        $('#phone-check').text("");
        $('#alt-phone-check').text("");
        $('required-duration-worked').text("");

        if (firstName === "") {
          $('#required-first-name').text("First Name is required");
          return false;
        }
        if (last_name === "") {
          $('#required-last-name').text("Last Name is required");
          return false;
        }
        if (id_no === "" && country==1) {
          $('#required-id-no').text("ID Number is required");
          return false;
        }
        if (phone_no === "") {
          $('#required-phone-no').text("Phone Number is required");
          return false;
        }else if (!validatePhoneNumber(phone_no)){
        
          $('#phone-check').text("enter correct phone format")
          return false;
        }
        if (year_worked === "") {
          $('#required-year-worked').text("Year Worked is required");
          return false;
        }
        if (duration_worked == ""){
        $('required-duration-worked').text("duration worked is required");
        }
        
        else if (alt_phone_no !="" && !validatePhoneNumber(alt_phone_no) ){
          $('#alt-phone-check').text("enter correct phone format")
          return false
        }
  
  
        return true; 
      }
      function validatePhoneNumber(phone_no) {
        var pattern = /^(254|256|265)\s\d{3}\s\d{3}\s\d{3}$|^(07|01|06)\d{8}$/;
        
        return pattern.test(phone_no);
      }
    

 
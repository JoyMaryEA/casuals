


    <div class="add-casual-container ">
    <?php if(!empty($casual) ){  ?>
    
        <form id="edit-form" class="add-casual" action="<?php echo URL; ?>casuals/editCasual" method="post">
                
        <?php } else { ?>

        <form id="add-form" class="add-casual" action="<?php echo URL; ?>casuals/addCasual" method="post">
    <?php } ?>

        <h4 style="text-align:center;"> <?php if(!empty($casual)){echo 'Edit Details for ' . $casual->first_name;} else echo "Enter Casual Details" ?></h4>
    <!-- casual_id -->
    <div style="display:none;">
    <label for="casual_id">Casual ID:</label>
    <input type="text" id="casual_id" name="casual_id" maxlength="6"  value="<?php if(!empty($casual)){echo  $casual->casual_id;} ?>" readonly >
    <br>
    </div>
    
   

    <!-- country -->
    <label for="country">Country: </label>
    <p></p> 
    <select class="custom-select custom-select-lg mb-3" name="country" id="country_select" required  >

                <?php foreach ($countries as $country) { ?>
                <option value="<?php if (isset($country->id)) echo htmlspecialchars($country->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($country->name)) echo htmlspecialchars($country->name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
                <?php if(!empty($casual)){ ?> 
                <option value="<?php  echo htmlspecialchars($casual->country, ENT_QUOTES, 'UTF-8'); ?>" selected><?php  echo htmlspecialchars($casual->country_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
    </select>
              <br>

    
    <!-- program -->
    <label for="program">Program:</label>
    <p></p>
    <select class="custom-select custom-select-lg mb-3" name="program" id="program_select">
    <?php foreach ($programs as $program) { ?>
        <option value="<?php echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>" <?php if(!empty($casual) && $casual->program_id == $program->id) echo 'selected'; ?>>
            <?php echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?>
        </option>
        <?php } ?>
    </select>

              <br>
    

    <!-- first_name -->
    <label for="first_name">First Name: <span style = "color:#e60000;"> *</span></label>
    <p id="required-first-name"><?php if(!empty($required))echo $required;?></p>
    <input type="text" id="first_name" name="first_name" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->first_name;} ?>" >
    <br>

    <!-- middle_name -->
    <label for="middle_name">Middle Name:</label>
    <p></p>
    <input type="text" id="middle_name" name="middle_name" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->middle_name;} ?>">
    <br>

    <!-- last_name -->
    <label for="last_name">Last Name:<span style = "color:#e60000;"> *</span></label>
    <p id="required-last-name"><?php if(!empty($required))echo $required;?></p>
    <input type="text" id="last_name" name="last_name" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->last_name;} ?>" >
    <br>

    <!-- id_no -->
    <label for="id_no">ID Number:<span style = "color:#e60000;"> *</span></label>
    <p id="required-id-no"><?php if(!empty($required))echo $required;?></p>
    <input type="text" id="id_no" name="id_no" maxlength="8" minlength="8" pattern="[0-9]{8}" value="<?php if(!empty($casual)){echo  $casual->id_no;} ?>" >
    <br>

    <!-- phone_no -->
    <label for="phone_no">Phone Number<span id="phone-code"></span>:<span style = "color:#e60000;"> *</span> </label>
    <p id="required-phone-no"><?php if(!empty($required))echo $required;?></p>
    <p id="phone-check"><?php if(!empty($wrong_phone))echo $wrong_phone;?></p>
    <div class="phone-wrapper" style="display:flex;">
    <!-- Select for phone country code -->
    <select name="phone_country_code" id="phone_country_code" class="phone-country-code custom-select " style="width:150px">
        
            <?php foreach ($countriesPhoneCode as $phone_code) { ?>
    
        <option value="<?php if (isset($phone_code->phone_code)) echo htmlspecialchars($phone_code->phone_code, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($phone_code->phone_code)) echo htmlspecialchars($phone_code->phone_code, ENT_QUOTES, 'UTF-8'); ?></option>
            <?php } ?>
         
    </select>
    <!-- Input for phone number -->
    <input style="margin:0; " type="tel" id="phone_no" name="phone_no" maxlength="10" minlength="10" placeholder='07********' pattern="^0[0-9]{9}$"  value="<?php if(!empty($casual) && !empty($casual->phone_no)){echo  "0" . substr($casual->phone_no, 3);} ?>" class="phone-number">
    </div>
    <br>

    <!-- alt_phone_no -->
    <label for="alt_phone_no">Alternative Phone Number<span id="phone-code"></span>: </label>
    <p id="alt-phone-check"><?php if(!empty($wrong_phone))echo $wrong_phone;?></p>
    <div class="phone-wrapper" style="display:flex;">
    <!-- Select for phone country code -->
    <select name="alt_phone_country_code" id="phone_country_code" class="phone-country-code custom-select " style="width:150px">
        
            <?php foreach ($countriesPhoneCode as $phone_code) { ?>
    
        <option value="<?php if (isset($phone_code->phone_code)) echo htmlspecialchars($phone_code->phone_code, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($phone_code->phone_code)) echo htmlspecialchars($phone_code->phone_code, ENT_QUOTES, 'UTF-8'); ?></option>
            <?php } ?>
         
    </select>
    <input style="margin:0; " type="tel" id="alt_phone_no" name="alt_phone_no" maxlength="10" minlength="10" placeholder='07********' pattern="^0[0-9]{9}$" value="<?php if(!empty($casual) && !empty($casual->alt_phone_no)){echo  "0" . substr($casual->alt_phone_no, 3);;} ?>" >
    </div>
    <br>

    <!-- year_worked -->
    <label for="year_worked">Year:<span style="color:#e60000;"> *</span></label>
    <p id="required-year-worked"><?php if (!empty($required)) echo $required; ?></p>
    <select class="custom-select custom-select-lg mb-3" id="year_worked" name="year_worked">
    <option value="" <?php if (empty($casual->year_worked)) echo 'selected'; ?>></option>
       <?php
        // Loop to populate the dropdown with years
        $currentYear = date('Y');
        $earliestYear = 2010;
        while ($currentYear >= $earliestYear) {
            echo '<option value="' . $currentYear . '"';
            if (!empty($casual) && $casual->year_worked == $currentYear) {
                echo ' selected';
            }
            echo '>' . $currentYear . '</option>';
            $currentYear--;
        }
        ?>
    </select>
    <br>



    <!-- duration_served -->
    <label for="duration_worked">Duration (days):<span style = "color:#e60000;"> *</span></label>
    <p id="required-duration-worked"><?php if(!empty($required))echo $required;?></p>
    <input type="number" id="duration_worked" name="duration_worked" maxlength="50" min="1" value="<?php if(!empty($casual)){echo  $casual->duration_worked;} ?>" >
    <br>

    <!-- comment -->
    <label for="comment">Comment:</label>
    <p></p>
    <input type="text" id="comment" name="comment" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->comment;} ?>">
    <br>

    <!-- kcse_results -->
    <label id="kcse-label" for="kcse_results">KCSE Results:</label>
    <p></p>
    <select id="kcse-input" class="custom-select custom-select-lg mb-3" name="kcse_results"  >

        <option value="">select grade</option>            
            <?php foreach ($kcse_results as $kcse_mark) { ?>
    
        <option value="<?php if (isset($kcse_mark->id)) echo htmlspecialchars($kcse_mark->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($kcse_mark->name)) echo htmlspecialchars($kcse_mark->name, ENT_QUOTES, 'UTF-8'); ?></option>
            <?php } ?>
            <?php if(!empty($casual)){ ?> 
        <option value="<?php echo isset($casual->kcse_results) ? htmlspecialchars($casual->kcse_results, ENT_QUOTES, 'UTF-8'): '';  ?>" selected><?php echo isset($casual->kcse_results_name) ? htmlspecialchars($casual->kcse_results_name, ENT_QUOTES, 'UTF-8'): ''; ?></option>
            <?php } ?>
    </select>
    <br>

    <!-- qualification -->
    <label for="qualification">Qualification:</label>
    <p></p>
    <select class="custom-select custom-select-lg mb-3" name="qualification" >
        <option value="">select qualification</option>                
            <?php foreach ($qualifications as $qualification) {  ?>
        <option value="<?php if (isset($qualification->id)) echo htmlspecialchars($qualification->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($qualification->name)) echo htmlspecialchars($qualification->name, ENT_QUOTES, 'UTF-8'); ?></option>
            <?php } ?>
            <?php if(!empty($casual)){ ?> 
        <option value="<?php echo isset($casual->qualification) ? htmlspecialchars($casual->qualification, ENT_QUOTES, 'UTF-8') : ''; ?>" selected> <?php echo isset($casual->qualification_name) ? htmlspecialchars($casual->qualification_name, ENT_QUOTES, 'UTF-8') : ''; ?></option>
            <?php } ?>

    </select>
    <br>

    <!-- institution -->
    <label for="institution">Institution:</label>
    <p></p>
    <select class="custom-select custom-select-lg mb-3" name="institution" id="institution" >
    <option value="">select institution</option> 
                
            <?php foreach ($institutions as $institution) { ?>
        <option value="<?php if (isset($institution->id)) echo htmlspecialchars($institution->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($institution->name)) echo htmlspecialchars($institution->name, ENT_QUOTES, 'UTF-8'); ?></option>
            <?php } ?>
            <?php if(!empty($casual)){ ?> 
        <option value="<?php  echo isset($casual->institution)? htmlspecialchars($casual->institution, ENT_QUOTES, 'UTF-8'): ''; ?>" selected><?php  echo isset($casual->institution_name) ? htmlspecialchars($casual->institution_name, ENT_QUOTES, 'UTF-8') :''; ?></option>
            <?php } ?>
    </select>
    <br>

    <!-- specialization -->
    <label for="specialization">Specialization:</label>
    <p></p>
    <input type="text" id="specialization" name="specialization" value="<?php if(!empty($casual)){echo  $casual->specialization;} ?>">
    <br>


    
    <input type="text" style="display:none;" name="staffProgramsId" value=<?php  echo isset($staffProgramsIdObj->id)? htmlspecialchars($staffProgramsIdObj->id, ENT_QUOTES, 'UTF-8'): ''; ?> >

    <!-- Submit Button --> 
    <?php if(!empty($casual)){?>
        <input type="submit" value="Submit" name="submit_edit_casual">
    
    <?php } else{ ?>
        <input type="submit" value="Submit" name="submit_add_casual">
    <?php } ?>
</form>
</div>

<script>
    $(document).ready(function() {

  //get the new casual_id
    $('#country_select').on('change', checkkcse);

// do validation on the edit casual form  
    $("#edit-form").submit(function(event) {
      event.preventDefault();
   
      if (validateEditForm($('#country_select').val())) {
          var formData = $(this).serialize();
            console.log(formData);
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
  
  $("#add-form").submit(function(event) {
    event.preventDefault();

    if (validateEditForm($('#country_select').val())) {
      this.submit();
    }

  })

});

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
        var pattern = /^\d{9,10}$/;

        
        return pattern.test(phone_no);
      }
    

 
</script>
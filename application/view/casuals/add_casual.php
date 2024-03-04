

    <div class="add-casual-container ">
    <?php if(!empty($casual) ){  ?>
    
        <form id="edit-form" class="add-casual" action="<?php echo URL; ?>casuals/editCasual" method="post">
                
        <?php } else { ?>

        <form id="add-form" class="add-casual" action="<?php echo URL; ?>casuals/addCasual" method="post">
    <?php } ?>

        <h4 style="text-align:center;"> <?php if(!empty($casual)){echo 'Edit Details for ' . $casual->first_name;} else echo "Enter Casual Details" ?></h4>

   

    <!-- country -->
    <label for="country">Country: </label> 
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
    <input type="text" id="id_no" name="id_no" maxlength="8" minlength="8"  value="<?php if(!empty($casual)){echo  $casual->id_no;} ?>" >
    <br>

    <!-- phone_no -->
    <label for="phone_no">Phone Number<span id="phone-code">(07********/01********)</span>:<span style = "color:#e60000;"> *</span> </label>
    <p id="required-phone-no"><?php if(!empty($required))echo $required;?></p>
    <p id="phone-check"><?php if(!empty($wrong_phone))echo $wrong_phone;?></p>
    <input type="text" id="phone_no" name="phone_no" maxlength="15" minlength="10" value="<?php if(!empty($casual)){echo  $casual->phone_no;} ?>" >
    <br>

    <!-- alt_phone_no -->
    <label for="alt_phone_no">Alternative Phone Number<span id="phone-code">(07********/01********)</span>: </label>
    <p id="alt-phone-check"><?php if(!empty($wrong_phone))echo $wrong_phone;?></p>
    <input type="text" id="alt_phone_no" name="alt_phone_no" maxlength="10" minlength="10" unique value="<?php if(!empty($casual)){echo  $casual->alt_phone_no;} ?>" >
    <br>

    <!-- year_worked -->
    <label for="year_worked">Year Worked:<span style = "color:#e60000;"> *</span></label>
    <p id="required-year-worked"><?php if(!empty($required))echo $required;?></p>
    <input type="text" id="year_worked" name="year_worked" value="<?php if(!empty($casual)){echo  $casual->year_worked;} ?>" >
    <br>


    <!-- duration_served -->
    <label for="duration_worked">Duration Served (days):<span style = "color:#e60000;"> *</span></label>
    <p id="required-duration-worked"><?php if(!empty($required))echo $required;?></p>
    <input type="number" id="duration_worked" name="duration_worked" maxlength="50" value="<?php if(!empty($casual)){echo  $casual->duration_worked;} ?>" >
    <br>

    <!-- comment -->
    <label for="comment">Comment:</label>
    <input type="text" id="comment" name="comment" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->comment;} ?>">
    <br>

    <!-- kcse_results -->
    <label id="kcse-label" for="kcse_results">KCSE Results:</label>
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
    $(document).ready(function(){
  $("#year_worked").datepicker({
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
     autoclose:true
  });   
})
</script>
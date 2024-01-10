<?php
 include APP . 'config/session.php';
?>
<div class="add-casual-container">
<?php if(!empty($casual)){?>
    <form class="add-casual" action="<?php echo URL; ?>casuals/editCasual" method="post">
   
            <?php } else { ?>
<form class="add-casual" action="<?php echo URL; ?>casuals/addCasual" method="post">
<?php } ?>
<h5> <?php if(!empty($casual)){echo 'Edit Details for ' . $casual->first_name;} else echo "Enter Casual Details" ?></h5>

    <!-- casual_id -->
    <label for="casual_id">Casual ID:</label>
    <input type="text" id="casual_id" name="casual_id" maxlength="6" required value="<?php if(!empty($casual)){echo  $casual->casual_id;} ?>"  >
    <br>

    <!-- country -->
    <label for="country">Country: </label> 
    <select class="custom-select custom-select-lg mb-3" name="country" required  >

                <?php foreach ($countries as $country) {  

                    ?>
                <option value="<?php if (isset($country->id)) echo htmlspecialchars($country->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($country->name)) echo htmlspecialchars($country->name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
                <?php if(!empty($casual)){ ?> 
                <option value="<?php  echo htmlspecialchars($casual->country, ENT_QUOTES, 'UTF-8'); ?>" selected><?php  echo htmlspecialchars($casual->country_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
              </select>
              <br>

    
    <!-- program -->
    <label for="program">Program:</label>
    <select class="custom-select custom-select-lg mb-3" name="program" value="<?php if(!empty($casual)){echo  $casual->country;} ?>" >

               
                <?php foreach ($programs as $program) {  

                    ?>
                <option value="<?php if (isset($program->id)) echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($program->name)) echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
                <?php if(!empty($casual)){ ?> 
                <option value="<?php  echo htmlspecialchars($casual->program, ENT_QUOTES, 'UTF-8'); ?>" selected><?php  echo htmlspecialchars($casual->program_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
              </select>
              <br>
    <br>

    <!-- first_name -->
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->first_name;} ?>">
    <br>

    <!-- middle_name -->
    <label for="middle_name">Middle Name:</label>
    <input type="text" id="middle_name" name="middle_name" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->middle_name;} ?>">
    <br>

    <!-- last_name -->
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->last_name;} ?>">
    <br>

    <!-- id_no -->
    <label for="id_no">ID Number:</label>
    <input type="text" id="id_no" name="id_no" maxlength="8" unique value="<?php if(!empty($casual)){echo  $casual->id_no;} ?>">
    <br>

    <!-- phone_no -->
    <label for="phone_no">Phone Number:</label>
    <input type="text" id="phone_no" name="phone_no" maxlength="15" unique value="<?php if(!empty($casual)){echo  $casual->phone_no;} ?>">
    <br>

    <!-- alt_phone_no -->
    <label for="alt_phone_no">Alternative Phone Number:</label>
    <input type="text" id="alt_phone_no" name="alt_phone_no" maxlength="15" unique value="<?php if(!empty($casual)){echo  $casual->alt_phone_no;} ?>" >
    <br>

    <!-- year_worked -->
    <label for="year_worked">Year Worked:</label>
    <input type="text" id="year_worked" name="year_worked" value="<?php if(!empty($casual)){echo  $casual->year_worked;} ?>" >
    <br>

    <!-- duration_served -->
    <label for="duration_served">Duration Served:</label>
    <input type="text" id="duration_served" name="duration_served" maxlength="50" value="<?php if(!empty($casual)){echo  $casual->duration_worked;} ?>" >
    <br>

    <!-- comment -->
    <label for="comment">Comment:</label>
    <input type="text" id="comment" name="comment" maxlength="55" value="<?php if(!empty($casual)){echo  $casual->comment;} ?>">
    <br>

    <!-- kcse_results -->
    <label for="kcse_results">KCSE Results:</label>
    <select class="custom-select custom-select-lg mb-3" name="kcse_results" required >

                
<?php foreach ($kcse_results as $kcse_mark) {  

    ?>
<option value="<?php if (isset($kcse_mark->id)) echo htmlspecialchars($kcse_mark->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($kcse_mark->name)) echo htmlspecialchars($kcse_mark->name, ENT_QUOTES, 'UTF-8'); ?></option>
<?php } ?>
<?php if(!empty($casual)){ ?> 
                <option value="<?php  echo htmlspecialchars($casual->kcse_results, ENT_QUOTES, 'UTF-8'); ?>" selected><?php  echo htmlspecialchars($casual->kcse_results_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
</select>
    <br>

    <!-- qualification -->
    <label for="qualification">Qualification:</label>
    <select class="custom-select custom-select-lg mb-3" name="qualification" required>

                
<?php foreach ($qualifications as $qualification) {  

    ?>
<option value="<?php if (isset($qualification->id)) echo htmlspecialchars($qualification->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($qualification->name)) echo htmlspecialchars($qualification->name, ENT_QUOTES, 'UTF-8'); ?></option>
<?php } ?>
<?php if(!empty($casual)){ ?> 
                <option value="<?php  echo htmlspecialchars($casual->qualification, ENT_QUOTES, 'UTF-8'); ?>" selected><?php  echo htmlspecialchars($casual->qualification_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>

</select>
    <br>

    <!-- institution -->
    <label for="institution">Institution:</label>
    <select class="custom-select custom-select-lg mb-3" name="institution" required>

                
<?php foreach ($institutions as $institution) {  

    ?>
<option value="<?php if (isset($institution->id)) echo htmlspecialchars($institution->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($institution->name)) echo htmlspecialchars($institution->name, ENT_QUOTES, 'UTF-8'); ?></option>
<?php } ?>
<?php if(!empty($casual)){ ?> 
                <option value="<?php  echo htmlspecialchars($casual->institution, ENT_QUOTES, 'UTF-8'); ?>" selected><?php  echo htmlspecialchars($casual->institution_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
</select>
    <br>

    <!-- year_graduated -->
    <label for="year_graduated">Year Graduated:</label>
    <input type="text" id="year_graduated" name="year_graduated" value="<?php if(!empty($casual)){echo  $casual->year_graduated;} ?>">
    <br>
<!-- 
    not_available -->
    <!-- <label for="not_available">Available:</label>
    <input type="checkbox" id="not_available" name="not_available" value=1>
    <br> -->

    <!-- Submit Button --> 
    <?php if(!empty($casual)){?>
        <input type="submit" value="Submit" name="submit_edit_casual">
    
            <?php } else{ ?>
            <input type="submit" value="Submit" name="submit_add_casual">
            <?php } ?>
</form>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<div style="display:flex; align-items:center; justify-content:center;">
  <div class="return-casual-cont container mt-5" id="ReturnCasualContainer" style="width:50%; ">
    <h4 style="text-align:center;">Return Casual Form</h4>
    <p style="margin:1rem ; color:#E600A0;">
    <?php if(!empty($casual)){
        if (empty($casual->id_no)){
            $casual->id_no = '[null]';
        }
        if (empty($casual->year_worked)){
            $casual->year_worked = '[null]';
        }
        echo "NB: Updating the record for $casual->first_name $casual->middle_name $casual->last_name who served in $casual->program_name in $casual->year_worked with id number $casual->id_no";
    } ?>
    </p>
    
    
   
     <form class="return-casual-form" id="return-casual-form" action="<?php echo URL; ?>casuals/insertReturnCasual" method="post">
        <div class="form-group">
            <label for="casual_id">Casual ID:<span style="color:#e60000;"> *</span></label>
            <input type="text" class="" id="casual_id" name="casual_id" value="<?php if(!empty($casual)){echo  $casual->casual_id;} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="program">Program:<span style="color:#e60000;"> *</span></label>
            <select class="custom-select custom-select-lg mb-3" name="program" id="program_select" value="" >
                <?php foreach ($programs as $program) {  ?>
                    <option value="<?php if (isset($program->id)) echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($program->name)) echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
             
    <label for="year_worked">Year:<span style="color:#e60000;"> *</span></label>
    <select class="custom-select custom-select-lg mb-3" id="year_worked" name="year_worked" required>
        <?php
        // Loop to populate the dropdown with years
        $currentYear = date('Y');
        $earliestYear = 2010;
        while ($currentYear >= $earliestYear) {
            echo '<option value="' . $currentYear . '"';
           
            echo '>' . $currentYear . '</option>';
            $currentYear--;
        }
        ?>
    </select>
    <br>

        </div>
        <div class="form-group">
            <label for="duration">Duration:<span style="color:#e60000;"> *</span></label>
            <input type="text" class="" id="duration" name="duration"  required>
        </div>
        <div class="form-group" style="display:none;">
            <label for="duration_worked">Duration:<span style="color:#e60000;"> *</span></label>
            <input type="text" class="" id="duration_worked" name="duration_worked"  required>
        </div>
        <button type="submit" name="submit_return_casual" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<script>
$(function() {
  $('input[name="duration"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    
    // Calculate the duration in days
    var duration = end.diff(start, 'days');
    console.log(duration);
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    $("#duration_worked").val(duration)  
  });
});

</script>
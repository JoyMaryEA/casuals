<div style="display:flex; align-items:center; justify-content:center;">
  <div class="return-casual-cont container mt-5" id="ReturnCasualContainer" style="width:50%; ">
    <h4 style="text-align:center;">Return Casual Form</h4>
     <form class="return-casual-form" id="return-casual-form" action="<?php echo URL; ?>casuals/insertReturnCasual" method="post">
        <div class="form-group">
            <label for="casual_id">Casual ID:</label>
            <input type="text" class="" id="casual_id" name="casual_id" required>
        </div>
        <div class="form-group">
            <label for="program">Program:</label>
            <select class="custom-select custom-select-lg mb-3" name="program" id="program_select" value="" >
                <?php foreach ($programs as $program) {  ?>
                    <option value="<?php if (isset($program->id)) echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($program->name)) echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year_worked">Year Worked:</label>
            <input type="year" class="" id="year_worked" name="year_worked" required>
        </div>
        <div class="form-group">
            <label for="duration_worked">Duration Worked:</label>
            <input type="number" class="" id="duration_worked" name="duration_worked" required>
        </div>
        <button type="submit" name="submit_return_casual" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#duration_worked").datepicker({
    dateFormat: "yyyy",
    changeYear: true,
    changeMonth: false,
    yearRange: "1900:+0",
    autoclose:true
  });   
})
</script>
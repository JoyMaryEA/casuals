<?php
$_SESSION['last_action'] = time();
?>


<div class="filter-container" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">  
        <form class="filters" action="<?php echo URL; ?>casuals/filter" method="POST">
        <select class="form-control" name="country" >

        <option value="" >Select Country</option>        
<?php foreach ($countries as $country) {  

    ?>
    
<option value="<?php if (isset($country->id)) echo htmlspecialchars($country->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($country->name)) echo htmlspecialchars($country->name, ENT_QUOTES, 'UTF-8'); ?></option>
<?php } ?>
</select>
              <select class="form-control" name="program">
              <option value="" style="color: gray;">Select Program</option>
               
<?php foreach ($programs as $program) {  

    ?>
<option style="color: black;" value="<?php if (isset($program->id)) echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($program->name)) echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?></option>
<?php } ?>
</select>
<!-- <select class="custom-select custom-select-lg mb-3" name="year">
              <option value="">Select Year</option>
               
<?php foreach ($programs as $program) {  

    ?>
<option value="<?php if (isset($program->id)) echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($program->name)) echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?></option>
<?php } ?>
</select> -->
<br>

              <input class="bt-filter" type="submit" name="submit_filter" value="Filter" />
            
                </form>
                
          <form class="form-inline"  action="<?php echo URL; ?>casuals/search" method="post">
            <input class="form-control mr-sm-2" style="width:310px;" type="search" name="search_str" placeholder="Search casual by id/first or last name" aria-label="Search">
            <input class="bt-filter " style="display:none;" type="submit" name="submit_search" value="search"/>
          </form>
        
</div>

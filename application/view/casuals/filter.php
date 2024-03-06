
<div class="filter-container" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">  
<?php if (!empty($results)) {echo $results;}?>

  <form class="filters" action="<?php echo URL; ?>casuals/filter" method="POST">
    <select class="form-control" name="country" >
        <option value="" style="color: gray;" >Select Country</option>        
          <?php foreach ($countries as $country) { ?>
    
        <option style="color: black;"  value="<?php if (isset($country->id)) echo htmlspecialchars($country->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($country->name)) echo htmlspecialchars($country->name, ENT_QUOTES, 'UTF-8'); ?></option>
          <?php } ?>
      </select>
              
    <select class="form-control" name="program">
        <option value="" style="color: gray;">Select Program</option>
          <?php foreach ($programs as $program) {   ?>
        <option style="color: black;" value="<?php if (isset($program->id)) echo htmlspecialchars($program->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($program->name)) echo htmlspecialchars($program->name, ENT_QUOTES, 'UTF-8'); ?></option>
          <?php } ?>
    </select>

            <br>

    <button class="bt-filter " type="submit" name="submit_filter" value="Filter"><span class="material-symbols-outlined">filter_list</span></button>
  </form>
                
  <div>
<a class="nav-link" href="<?php echo URL; ?>casuals/search" >Search for a specific casual</a>
</div>


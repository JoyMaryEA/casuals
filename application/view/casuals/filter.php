

<div class="filter-container" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">  
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

    <input class="bt-filter" type="submit" name="submit_filter" value="Filter" />
            
  </form>
                
  <form class=" form-inline" id="search-form"  >
    <input class="form-control mr-sm-2" style="width:310px;" type="search" name="search_str" id="search_str" placeholder="search id / phone / first or last name" aria-label="Search">
    <input class="bt-filter " style="display:none;" type="submit" name="submit_search" value="search"/>
  </form>
        
</div>

<div id="table-container" class="table-responsive" style="display:none; ">
     <div class="table-wrapper" >
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Staff <b>Details</b></h2>
                </div>
            </div>
        </div>
        <table id="casualsTable"  style="width:100%"class="table table-striped table-hover table-bordered">
   <thead>
     <tr>
       
      
       
       <th>First Name </th>
       <th>Last Name</th>
       <th>Program </th>
       <th>Country </th>
       <th>Casual Id </th>
       <th>Phone Number</th>                       
       <th>Duration of Appointment (days)</th>
       <th>year worked</th>
       
     </tr>
    </thead>
  </table>
   </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables plugin JavaScript and CSS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type= "text/javascript">
// ajax get casuals, for search
$(document).ready(function() {
  $('#table-container').hide();
  var dataTable = new DataTable('#casualsTable', {
        columns: [
            { data: 'first_name'  },
            { data: 'last_name'  },
            { data: 'program_name' },
            { data: 'country_name' },
            { data: 'casual_id' },
            { data: 'phone_no'  },
            { data: 'duration_worked'  },
            { data: 'year_worked'  }
        ],
       
    });

  var userRole = <?php echo json_encode($_SESSION['role']); ?>;
$("#search-form").submit(function (event){
  event.preventDefault();
 
 var formData = {search_str : $("#search_str").val()};

$.ajax({
  url: '<?php echo URL; ?>casuals/searchAction',
  type: 'POST', 
  data:  formData,
  dataType: 'json',
  success: function(data) {
        console.log(data); 
        $('#table-container').show();
        dataTable.clear().rows.add(data).draw();
        
  },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('AJAX Error:', textStatus, errorThrown);
        console.log('Server Response:', jqXHR.responseText);
    }

})


});



})
</script>
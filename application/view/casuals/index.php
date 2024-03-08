

<div id="table-container" class="table-responsive" style="display:none; ">
     <div class="table-wrapper" >
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-8">
                      <h6>Staff details inserted today</h6>
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
                  <th>Year worked</th>
              
                </tr>
                </thead>
          </table>
   </div>
 


</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables plugin JavaScript and CSS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type= "text/javascript">

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
            { data: 'duration_worked' },
            { data: 'year_worked'  },
         
        ],dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'pdf', 'print'
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        lengthChange: true
       
    });



})
</script>     

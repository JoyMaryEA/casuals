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
                  <th>action</th>
                </tr>
                </thead>
          </table>
   </div>
  
   <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalId-label" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="modalId-label">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete casual ${casualId} : ${data.first_name}?
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <a class="btn-delete"  href="deleteUrl" >delete</a>
          </div>
      </div>
     </div>
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
            { data: 'duration_worked'  },
            { data: 'year_worked'  },
            { data: null,
                render: function(data, type, row) {
                    var casualId = data.casual_id;
                    var modalId = `delete-modal-${casualId}`
                    var deleteUrl = '<?php echo URL . 'casuals/deleteCasual/'; ?>' + casualId;
                    var editUrl = '<?php echo URL . 'casuals/addCasual/'; ?>' + casualId;
                  
                    return `<a href="${editUrl}" class="edit" title="Edit" data-toggle="tooltip" > <span class="material-symbols-outlined">edit</span></a>
                    <a href="#" id="delete-casual" class="delete" title="Delete" data-toggle="modal" data-target="#${modalId}" data-casual-id="${casualId}" data-casual-data="${data.first_name}" data-delete-url="${deleteUrl}" > <span class="material-symbols-outlined">delete</span> </a>
                `;
               }
            }
        ],dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'pdf', 'print'
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        lengthChange: true
       
    });

  var userRole = <?php echo json_encode($_SESSION['role']); ?>; //TODO: DIFFERENCIATE ADMIN AND USER

$("#search-form").submit(function (event){
    event.preventDefault();
 
    var formData = {search_str : $("#search_str").val()};
      // ajax get casuals, for search
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

function generateModal(modalId, casualId, data, deleteUrl) {
    var modalHTML = `
        <div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-labelledby="${modalId}-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="${modalId}-label">Delete Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete casual ${casualId} : ${data}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a class="btn-delete" href="${deleteUrl}" >delete</a>
                    </div>
                </div>
            </div>
        </div>`;
    
    // Append modal HTML to the body
    $('body').append(modalHTML);
}

$('#delete-casual').on('click', function() {
  console.log("clicked");
    // Extract necessary data for the modal
    var modalId = $(this).data('target').substring(1); // Remove #
    var casualId = $(this).data('casual-id');
    var data = $(this).data('casual-data');
    var deleteUrl = $(this).data('delete-url');
    
    // Generate and append modal HTML
    generateModal(modalId, casualId, data, deleteUrl);
});
})
</script>
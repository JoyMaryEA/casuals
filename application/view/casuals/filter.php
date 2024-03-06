
<div class="filter-container" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">  


  <form class="filters" id="filter-form" action="<?php echo URL; ?>casuals/filter" method="POST">
    <select class="form-control" name="country" id="country" >
        <option value="" style="color: gray;" >Select Country</option>        
          <?php foreach ($countries as $country) { ?>
    
        <option style="color: black;"  value="<?php if (isset($country->id)) echo htmlspecialchars($country->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($country->name)) echo htmlspecialchars($country->name, ENT_QUOTES, 'UTF-8'); ?></option>
          <?php } ?>
      </select>
              
    <select class="form-control" name="program" id="program">
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

<div id="table-container" class="table-responsive" style="display:none; ">
     <div class="table-wrapper" >
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-8">
                      <h2>Staff <b>Details</b></h2>
                  </div>
              </div>
          </div>
          <!-- <p><?php echo $results?></p> -->
          <table id="casualsTableFilter"  style="width:100%"class="table table-striped table-hover table-bordered">
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
 


</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables plugin JavaScript and CSS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type= "text/javascript">
function generateDeleteModal(modalId, casualId, firstname, deleteUrl) {
 
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
                                                Are you sure you want to delete casual ${casualId} : ${firstname}?
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

function generateDetailsModal(modalId,data){
console.log(data);
 var modalHTML =` <div class="modal fade" id="${modalId}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Information:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item"><span>Casual Id: </span>${data.casual_id}</li>
                <li class="list-group-item"><span>First Name: </span>${data.first_name}</li>
                <li class="list-group-item"><span>Middle Name: </span>${data.middle_name}</li>
                <li class="list-group-item"><span>Last Name: </span>${data.last_name}</li>
                <li class="list-group-item"><span>Id Number: </span>${data.id_no}</li>
                <li class="list-group-item"><span>Country: </span>${data.country_name}</li>
                <li class="list-group-item"><span>Qualification: </span>${data.qualification_name}</li>
                <li class="list-group-item"><span>Institution: </span>${data.institution_name}</li>
                <li class="list-group-item"><span>Specialization: </span>${data.specialization}</li>
                <li class="list-group-item"><span>Comment: </span>${data.comment}</li>
                </ul>
            </div>
           
            </div>
        </div>
    </div>
    </div>`
       // Append modal HTML to the body
       $('body').append(modalHTML);
}
function getCasualDetails(modalId,casualId){
    var formData = {search_str :casualId };
    console.log(formData);
    $.ajax({
      url: '<?php echo URL; ?>casuals/searchAction',
      type: 'POST', 
      data:  formData,
      dataType: 'json',
      success: function(data) {
            console.log(data[0]); 
            generateDetailsModal(modalId,data[0])
            },
      error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            console.log('Server Response:', jqXHR.responseText);
        }

    })
        
}




$(document).ready(function() {
 
  $('#table-container').hide();
  
  var dataTable = new DataTable('#casualsTableFilter', {
      
   
        columns: [
            { data: 'first_name'  },
            { data: 'last_name'  },
            { data: 'program_name' },
            { data: 'country_name' },
            { data: 'casual_id' },
            { data: 'phone_no'  },
            { data: 'duration_worked' },
            { data: 'year_worked'  },
            { data: null,
                render: function(data, type, row) {
                    var casualId = data.casual_id;
                    var deleteModalId = `delete-modal-${casualId}`
                    var casualDetailsModalId = `details-modal-${casualId}`
                    var deleteUrl = '<?php echo URL . 'casuals/deleteCasual/'; ?>' + casualId;
                    var editUrl = '<?php echo URL . 'casuals/addCasual/'; ?>' + casualId;    
                    var returnUrl = '<?php echo URL . 'casuals/insertReturnCasual/'; ?>' + casualId;       
                    var userRole = <?php echo json_encode($_SESSION['role']); ?>; //TODO: DIFFERENTIATE ADMIN AND USER
                    return `
                    <a href="#" style="padding:0px;margin:0px;"  class="view" title="View" data-toggle="modal" data-target="#${casualDetailsModalId}" id="detailsA" onclick="getCasualDetails('${casualDetailsModalId}',${casualId})" data-toggle="modal" >
                        <span class="material-symbols-outlined">visibility</span>
                    </a>
                    ${userRole == 2 ? '' : `
                    <a href="${editUrl}" style="padding:0px;margin:0px;" class="edit" title="Edit" data-toggle="tooltip" > <span class="material-symbols-outlined">edit</span></a> 
                    <a href="${returnUrl}" style="padding:0px;margin:0px;"  class="edit" title="Return" data-toggle="tooltip" > <span class="material-symbols-outlined">replay</span></a>
                        <a href="#" style="padding:0px;margin:0px;"  id="delete-casual" class="delete" title="Delete" onclick="generateDeleteModal('${deleteModalId}', '${casualId}', '${data.first_name}', '${deleteUrl}')" data-toggle="modal"  data-target="#${deleteModalId}"  >
                            <span class="material-symbols-outlined">delete</span>
                        </a> `}

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

 
$("#filter-form").submit(function (event){
    event.preventDefault();

    var formData = {country : $("#country").val(), program: $("#program").val() };
    console.log(formData);
      // ajax get casuals, for filter
    $.ajax({
      url: '<?php echo URL; ?>casuals/filterAction',
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

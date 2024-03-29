
<div class="filter-container" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">  
<form class="" id="search-form"  >
<div style="margin-top:3rem; display:flex; flex-direction:row;">
<input class="form-control mr-sm-2" style="width:410px; height:3rem" type="search" name="search_str" id="search_str" placeholder="search id / phone / first or last name" aria-label="Search">
    <button class="bt-filter " type="submit" name="submit_search" value="search" style="height:3rem"><span >Search</span></button>
</div>
   
  </form>
        


</div>
<div id="table-container" class="table-responsive" style="display:none; width:80%">
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
 


</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables plugin JavaScript and CSS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.js"></script>
<script type= "text/javascript">
    // TODO : MERGE WITH FILTER ON INDEX.PHP
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
            <div class="modal-footer">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === "1") { ?>
                <?php $last_edit = $this->model-> getAudit('<script>document.write(data.casual_id);</script>',2) ; $insert_by = $this->model-> getAudit('<script>document.write(data.casual_id);</script>',1); ?>
                <p><span style="font-weight:bold;">Last edited by:</span> <?php if (isset($last_edit->email)) {echo htmlspecialchars(strstr($last_edit->email, '@', true), ENT_QUOTES, 'UTF-8');} else{echo "admin";}?> <span style="font-weight:bold;"> on : </span><?php if (isset($last_edit->timestamp)) {echo htmlspecialchars($last_edit->timestamp, ENT_QUOTES, 'UTF-8'); } else {echo '1st Jan 2024';}?> </p>
                <p><span style="font-weight:bold;">Inserted by:</span> <?php if (isset($insert_by->email)) {echo htmlspecialchars(strstr($insert_by->email, '@', true), ENT_QUOTES, 'UTF-8');} else {echo 'admin';} ?></p>
                <?php } ?>
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
                    <a href="#" style="padding:0px;margin:0px;"  class="view" title="View" data-toggle="modal" data-target="#${casualDetailsModalId}" id="detailsA" onclick="getCasualDetails('${casualDetailsModalId}','${casualId}')" data-toggle="modal" >
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
            dataTable.clear(); 
            $('#table-container').show();          
            dataTable.rows.add(data).draw();  
            },
      error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            console.log('Server Response:', jqXHR.responseText);
        }

    })


});

})
</script>     
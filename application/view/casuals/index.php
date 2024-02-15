
<div class="table-responsive">
     <div class="table-wrapper">
     <div class="table-title">
     <div class="row">
        <div class="col-sm-8">
            <h2>Staff <b>Details</b></h2>
        </div>
    </div>
</div>


<table id="myTable" class="table table-striped table-hover table-bordered" >
    <thead>
     <tr>
       <th>#</th>
       <th>Country </th>
       <th>Program </th>
       <th>First Name </th>
       <th>Last Name</th>
       <th>Duration of Appointment (days)</th>
       <th>Phone Number</th>                       
       <th>Casual Id </th>
       <th>year worked</th>
       <th>Details</th>
     </tr>
    </thead>
<!-- <tbody>
         <?php $counter = 1; foreach ($casuals as $casual) {  ?>
     <tr>
        <td><?php echo $counter; ?></td>
        <td><?php if (isset($casual->country_name)) echo htmlspecialchars($casual->country_name, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($casual->program_name)) echo htmlspecialchars($casual->program_name, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($casual->first_name)) echo htmlspecialchars($casual->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($casual->last_name)) echo htmlspecialchars($casual->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo isset($casual->duration_worked) ? htmlspecialchars($casual->duration_worked, ENT_QUOTES, 'UTF-8') : ""; ?> </td>
        <td><?php if (isset($casual->phone_no)) echo htmlspecialchars($casual->phone_no, ENT_QUOTES, 'UTF-8');; ?></td>
        <td><?php if (isset($casual->casual_id)) echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($casual->year_worked)) echo htmlspecialchars($casual->year_worked, ENT_QUOTES, 'UTF-8'); ?></td>
        <td>
             <a href="#"  class="view" title="View" data-toggle="modal" data-target="#detailsModal<?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8') ?>" id="detailsA" >
                <span class="material-symbols-outlined">visibility</span>
             </a>
              <?php
                    if (isset($_SESSION['role']) && $_SESSION['role'] === "1") { ?>
             <a href="<?php echo URL . 'casuals/addCasual/' . htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?>" class="edit" title="Edit" data-toggle="tooltip" >
                 <span class="material-symbols-outlined">edit</span>
             </a>
            <a href="#"  class="delete" title="Delete" data-toggle="modal" data-target="#delete-modal<?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8') ?>" >
                <span class="material-symbols-outlined">delete</span> <?php $casualID = htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8')?>
             </a>
                 <?php } ?>
        </td>
    </tr>

    <div class="modal fade" id="detailsModal<?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8') ?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <li class="list-group-item"><span>Casual Id: </span><?php if (isset($casual->casual_id)) echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>First Name: </span><?php if (isset($casual->first_name)) echo htmlspecialchars($casual->first_name, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Middle Name: </span><?php if (isset($casual->middle_name)) echo htmlspecialchars($casual->middle_name, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Last Name: </span><?php if (isset($casual->last_name)) echo htmlspecialchars($casual->last_name, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Id Number: </span><?php if (isset($casual->id_no)) echo htmlspecialchars($casual->id_no, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Country: </span><?php if (isset($casual->country_name)) echo htmlspecialchars($casual->country_name, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Qualification: </span><?php if (isset($casual->qualification_name)) echo htmlspecialchars($casual->qualification_name, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Institution: </span><?php if (isset($casual->institution_name)) echo htmlspecialchars($casual->institution_name, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Specialization: </span><?php if (isset($casual->specialization)) echo htmlspecialchars($casual->specialization, ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item"><span>Comment: </span><?php if (isset($casual->comment)) echo htmlspecialchars($casual->comment, ENT_QUOTES, 'UTF-8'); ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === "1") { ?>
                <?php $last_edit = $this->model-> getAudit($casualID,2) ; $insert_by = $this->model-> getAudit($casualID,1); ?>
                <p><span style="font-weight:bold;">Last edited by:</span> <?php if (isset($last_edit->email)) echo htmlspecialchars(strstr($last_edit->email, '@', true), ENT_QUOTES, 'UTF-8'); ?> <span style="font-weight:bold;"> on : </span><?php if (isset($last_edit->timestamp)) echo htmlspecialchars($last_edit->timestamp, ENT_QUOTES, 'UTF-8'); ?> </p>
                <p><span style="font-weight:bold;">Inserted by:</span> <?php if (isset($insert_by->email)) echo htmlspecialchars(strstr($insert_by->email, '@', true), ENT_QUOTES, 'UTF-8'); ?></p>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade"  id="delete-modal<?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?>"  tabindex="-1" aria-labelledby="delete-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete casual: <?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
             <div class="modal-footer">
                <a class="btn-delete"  href="<?php echo URL . 'casuals/deleteCasual/'. htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?>" >
                        delete
                    </a>
                <button type="button" class="btn-cancel" data-dismiss="modal"> cancel </button>
            </div>
        </div>
    </div>
            <?php $counter++; } ?>
</tbody> -->
</table>
  
            







  

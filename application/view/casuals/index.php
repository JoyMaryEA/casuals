<?php
session_start();
?>
<div class="table-responsive">
     <div class="table-wrapper">
     <div class="table-title">
     <div class="row">
        <div class="col-sm-8">
            <h2>Staff <b>Details</b></h2>
        </div>
        <div class="col-sm-4">
            <div class="row">
            <!-- <?php
if (isset($_SESSION['role']) && $_SESSION['role'] != "1") {
    ?>  
                <div class="col-8">
                <div class="col-sm-4">
            <a href="<?php echo URL; ?>casuals/filter" style="color:#E600A0; cursor: pointer; padding: 0.3rem; font-weight: semi-bold; text-decoration: underline;">CLEAR FILTERS</a>
        </div>
                </div>
                <?php } ?>        -->
                <?php
if (isset($_SESSION['role']) && $_SESSION['role'] === "1") {
    ?>
    <div class="col-6">
    <form class="form-inline"  action="<?php echo URL; ?>casuals/search" method="post">
            <input class="form-control mr-sm-2" style="width:250px;" type="search" name="search_str" placeholder="Search casual by id/name" aria-label="Search">
            <input class="bt-filter " style="display:none;" type="submit" name="submit_search" value="search"/>
          </form>
                </div>
    <div class="col-6">
        <div class="add-casual-bt" >
            <a href="<?php echo URL; ?>casuals/addCasual" style="color:#E600A0; background-color:white;"  >ADD CASUAL</a>
            <!-- <span style="font-size:large;" class="material-symbols-outlined">person_add</span> -->
        </div>
    </div>
    <?php } ?>
            </div>
        </div>
    </div>
</div>


            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Country <i class="fa fa-sort"></i></th>
                        <th>Program <i class="fa fa-sort"></i></th>
                        <th>First Name <i class="fa fa-sort"></i></th>
                        <th>Last Name <i class="fa fa-sort"></i></th>
                        <?php if (!empty($casuals) && isset($casuals[0]->duration_worked)) { ?>
                         <th>Duration of Appointment</th>
                         <?php } ?>
                        
                        <?php if (!empty($casuals) && isset($casuals[0]->phone_no)) { ?>
                         <th>Phone Number</th>
                         <?php } ?>
                        <th>Casual Id *</th>
                        <th>Comment</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php $counter = 1; foreach ($casuals as $casual) {  

            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php if (isset($casual->country)) echo htmlspecialchars($casual->country, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($casual->program)) echo htmlspecialchars($casual->program, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($casual->first_name)) echo htmlspecialchars($casual->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($casual->last_name)) echo htmlspecialchars($casual->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php if (!empty($casual->duration_worked)) { ?>
                    <td><?php echo htmlspecialchars($casual->duration_worked, ENT_QUOTES, 'UTF-8'); ?></td>
                     <?php } ?>
                    <?php if (!empty($casual->phone_no)) { ?>
                    <td><?php echo htmlspecialchars($casual->phone_no, ENT_QUOTES, 'UTF-8'); ?></td>
                     <?php } ?>
                    <td><?php if (isset($casual->casual_id)) echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>OK</td>
                    <td>
   

                        <a href="#"  class="view" title="View" data-toggle="modal" data-target="#detailsModal<?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8') ?>" id="detailsA" >
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                      
                    
                                        <?php
                    if (isset($_SESSION['role']) && $_SESSION['role'] === "1") {
                        ?>
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
                            <li class="list-group-item"><span>Last Name: </span><?php if (isset($casual->last_name)) echo htmlspecialchars($casual->last_name, ENT_QUOTES, 'UTF-8'); ?></li>
                            <li class="list-group-item"><span>Program: </span><?php if (isset($casual->program)) echo htmlspecialchars($casual->program, ENT_QUOTES, 'UTF-8'); ?></li>
                            <li class="list-group-item"><span>Country: </span><?php if (isset($casual->country)) echo htmlspecialchars($casual->country, ENT_QUOTES, 'UTF-8'); ?></li>
                            <li class="list-group-item"><span>Qualification: </span>Bachelors Degree</li>
                            <li class="list-group-item"><span>Duration of Appointment: </span>10 days</li>
                            <li class="list-group-item"><span>Comment: </span>OK</li>
                          </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn-call" data-dismiss="modal"><span class="material-symbols-outlined">
                        call
                        </span></button>
                      
                         </div>
                         </div>
                          </div>
                     </div>
                    </div>


                    <div class="modal fade"  id="delete-modal<?php echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8') ?>"  tabindex="-1" aria-labelledby="delete-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirm Delete:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete casual: <?php echo htmlspecialchars($casualID, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
  <div class="modal-footer">
                      <a class="btn-delete" data-dismiss="modal" href="<?php echo URL . 'casuals/deleteCasual/' . htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?>" >
                        delete
                    </a>
                        <button type="button" class="btn-cancel" data-dismiss="modal">
                        cancel
                        </button>
                    </div>
</div>
                    </div>
            <?php $counter++; } ?>
                    
                    
                </tbody>
            </table>
  
            





              
            <div class="clearfix">
                <div class="hint-text">Showing <b>6</b> out of <b>30</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>  


  

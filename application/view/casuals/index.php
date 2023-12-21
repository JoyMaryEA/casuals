<div class="table-responsive">
     <div class="table-wrapper">
     <div class="table-title">
    <div class="row d-flex justify-content-between">
        <div class="col-sm-8">
            <h2>Staff <b>Details</b></h2>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo URL; ?>casuals/filter" style="color:#E600A0; cursor: pointer; padding: 0.3rem; font-weight: semi-bold; text-decoration: underline;">CLEAR FILTERS</a>
        </div>
    </div>
</div>


            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Country <i class="fa fa-sort"></i></th>
                        <th>Program <i class="fa fa-sort"></i></th>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <?php if (!empty($casuals) && isset($casuals[0]->duration_served)) { ?>
                         <th>Duration of Appointment</th>
                         <?php } ?>
                        
                        <?php if (!empty($casuals) && isset($casuals[0]->phone_no)) { ?>
                         <th>Phone Number</th>
                         <?php } ?>
                        <th>Casual Id *</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php $counter = 1; foreach ($casuals as $casual) {  
                $fullname = $casual->first_name . ' ' . $casual->last_name;
            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php if (isset($casual->country)) echo htmlspecialchars($casual->country, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($casual->program)) echo htmlspecialchars($casual->program, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php if (!empty($casual->duration_served)) { ?>
                    <td><?php echo htmlspecialchars($casual->duration_served, ENT_QUOTES, 'UTF-8'); ?></td>
                     <?php } ?>
                    <?php if (!empty($casual->phone_no)) { ?>
                    <td><?php echo htmlspecialchars($casual->phone_no, ENT_QUOTES, 'UTF-8'); ?></td>
                     <?php } ?>
                    <td><?php if (isset($casual->casual_id)) echo htmlspecialchars($casual->casual_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>OK</td>
                    <td>
                        <a href="#" class="view" title="View" data-toggle="modal" data-target="#exampleModal">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="#" class="edit" title="Call" data-toggle="tooltip">
                            <span class="material-symbols-outlined">call</span>
                        </a>
                    </td>
                </tr>
            <?php $counter++; } ?>
                    
                    
                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <li class="list-group-item"><span>Name: </span>Joy Mary</li>
                            <li class="list-group-item"><span>Program: </span>DtW</li>
                            <li class="list-group-item"><span>Country: </span>Kenya</li>
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
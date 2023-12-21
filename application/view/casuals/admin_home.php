<div class="table-responsive">
        <div class="table-wrapper">
        <div class="table-title">
    <div class="row">
        <div class="col-sm-8">
            <h2>Staff <b>Details</b></h2>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-8">
                    <div class="search-box " >
                        <i class="material-icons">&#xE8B6;</i>
                        <input type="text" class="form-control" placeholder="Search name/casual id&hellip;">
                    </div>
                </div>
                <div class="col-4">
                    <div class="add-casual" style="color:#E600A0; cursor: pointer; padding: 0.3rem; font-weight: semi-bold; text-decoration: underline;">
                    ADD CASUAL
                    
                        <!-- <span style="font-size:large;" class="material-symbols-outlined">person_add</span> -->
                     
                    </div>
                </div>
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
                        <a href="#" class="edit" title="Edit" data-toggle="tooltip" >
                        <span class="material-symbols-outlined">edit</span>
                        </a>
                        <a href="#" class="delete" title="Delete" data-toggle="tooltip">
                        <span class="material-symbols-outlined">delete</span>
                        </a>
                    </td>
                </tr>
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
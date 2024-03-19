<style>
    .btn-primary:hover, .btn-success:hover {
        background-color: #20253A;
        border-color: #20253A;
    }
    .text-color{
        color: #E600A0;
    }
    .above-container{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    #upload-form{
        margin-top:3rem;
    }
</style>
<div class="above-container">
<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 ">
            <a id="download-casuals-form" href="<?php echo URL; ?>bulkProcessing/downloadTemplate" class="btn btn-primary btn-block mb-3" style="border: #20253A .5px solid; color: #E600A0;">Download File Template</a>
            <form id="upload-form" method="POST" enctype="multipart/form-data">
                <h6 class="mb-3">Select File to Upload</h6>
                <input type="file" id="file" name="file" class="form-control mb-3">
                <input type="submit" name="submit-file" value="Upload" class="btn-block text-color">
            </form>
        </div>
    </div>
</div>
</div>

<div id="table-container" class="table-responsive" style="display:none; width:80% ">
     <div class="table-wrapper" >
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-8">
                      <h2>Staff details inserted today</h2>
                  </div>
              </div>
          </div>
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
                  <th>Year Worked</th>
               
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
          { data: 'year_worked'  }
      ],dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'pdf', 'print'
      ],
      lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      lengthChange: true
     
  });
    function getRecentCasuals(){
     
    $.ajax({
      url: '<?php echo URL; ?>bulkProcessing/getRecentInserts',
      type: 'GET',
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
}

   
  
       

    $("#upload-form").submit(function(event) {
        event.preventDefault();
        console.log("here");
        // Serialize the form data
        var formData = new FormData($(this)[0]);
        
        $.ajax({
            url: '<?php echo URL; ?>bulkProcessing/uploadTemplate',
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle the response here, if needed
                console.log(response);
                getRecentCasuals()
            },
      error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            console.log('Server Response:', jqXHR.responseText);
        }

    })
    });

 
});


</script>
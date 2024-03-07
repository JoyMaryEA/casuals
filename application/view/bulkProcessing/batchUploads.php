
<a href='<?php echo URL; ?>bulkProcessing/downloadTemplate'>Download Template</a>


<form id="upload-form"method="POST" enctype="multipart/form-data"> 
 <input type="file" id="file" name="file">
 <input type="submit" name="submit-file" value="Upload">
</form>

<script>
    $(document).ready(function() {
    $("#upload-form").submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        console.log("here");
        // Serialize the form data
        var formData = new FormData($(this)[0]);
        
        // Send an AJAX request to upload the file
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                console.log('Server Response:', jqXHR.responseText);
            }
        });
    });
});

</script>
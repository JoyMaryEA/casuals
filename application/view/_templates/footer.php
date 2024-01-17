
    <!-- backlink to repo on GitHub, and affiliate link to Rackspace if you want to support the project -->
    <div class="footer">
        Find <a href="https://github.com/panique/mini">MINI on GitHub</a>.
    </div>

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>


    <script src="<?php echo URL; ?>public/js/application.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>
    <?php if(empty($casual)) { ?> 
    <script>
$(document).ready(function() {
    $('#country_select').on('change', checkId);
    $('#program_select').on('change', checkId);
});

function checkId() {
    var countryValue = $('#country_select').val();
     var programValue = $('#program_select').val();

    $.ajax({
        url:         '/mini/casuals/getCasualId',
        type:       'POST',
        dataType:   'json',
        data:        { country: countryValue , program: programValue },
        success:    function(data) {
            console.log(data);
            var maxCasualId = data.max_casual_id;
            $('#casual_id').val(maxCasualId);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.error('AJAX Error:', textStatus, errorThrown);
        console.log('Server Response:', jqXHR.responseText);
    },
    complete: function() {
        console.log('Complete callback reached');
    }
    
    });
     
     
}
    </script>

 <?php }  ?>

</body>
</html>


    <!-- backlink to repo on GitHub, and affiliate link to Rackspace if you want to support the project -->
    <div class="footer">
        Find <a href="https://github.com/panique/mini">MINI on GitHub</a>.
    </div>

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

<script>
    $(document).ready(function() {
        // Attach a click event handler to the button
        $('#deleteButton').on('click', function() {
            // Get the casual_id from your HTML or any other source
            var casualId = "<?php echo htmlspecialchars($casualID, ENT_QUOTES, 'UTF-8'); ?>";

            // Make an AJAX request to your PHP script
            $.ajax({
                type: 'POST',
                url: '<?php echo URL . 'casuals/deleteCasual'; ?>',
                data: { casual_id: casualId },
                success: function(response) {
                    // Handle the success response, e.g., show a success message
                    console.log(response);
                },
                error: function() {
                    // Handle errors
                    console.log('Error occurred during AJAX request.');
                }
            });
        });
    });
</script>
 
 
</body>
</html>

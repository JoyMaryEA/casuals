<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidence Action</title>
<link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
<style>
    .modal {
    position: fixed; 
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-image: url('<?php echo URL . "img/bg_helper.png"; ?>');
    background-color: rgba(0, 0, 0, 0.2);
    background-size: cover;
    background-position: center;
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto; 
    padding: 20px;
    border: 1px solid #888;
    border-radius: 10px;
    width: 50%; 
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.form-group{
    display:flex;
    flex-direction:row;
    align-items:center;
    margin-top:.5rem;
    gap:.3rem;
}
.form-group input{
 height:.7rem;
 border-style:none;
}
.modal-content{
    border: 2px solid green; 
    box-shadow: 0 0 10px green;
}

    </style>
</head>
<body>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form-container">
            <form action="submit.php" method="POST">
            <div class="form-container">
                    <form action="submit.php" method="POST">
                        <p style="color:green;">Success! The following details were inserted:</p>
                        <div class="form-group">
                            <label for="cid">Casual Id:</label>
                            <input type="text" id="cid" name="cid" value='<?php if (isset($inserted_casual->casual_id)) echo htmlspecialchars($inserted_casual->casual_id, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <input type="text" id="country" name="country" value='<?php if (isset($inserted_casual->country_name)) echo htmlspecialchars($inserted_casual->country_name, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="program">Program:</label>
                            <input type="text" id="program" name="program" value='<?php if (isset($inserted_casual->program_name)) echo htmlspecialchars($inserted_casual->program_name, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" id="first_name" name="first_name" value='<?php if (isset($inserted_casual->first_name)) echo htmlspecialchars($inserted_casual->first_name, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label for="middle_name">Middle Name:</label>
                            <input type="text" id="middle_name" name="middle_name" value='<?php if (isset($inserted_casual->last_name)) echo htmlspecialchars($inserted_casual->last_name, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div> -->
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" value='<?php if (isset($inserted_casual->last_name)) echo htmlspecialchars($inserted_casual->last_name, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_no">ID Number:</label>
                            <input type="text" id="id_no" name="id_no" value='<?php if (isset($inserted_casual->id_no)) echo htmlspecialchars($inserted_casual->id_no, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone_no">Phone Number:</label>
                            <input type="tel" id="phone_no" name="phone_no" value='<?php if (isset($inserted_casual->phone_no)) echo htmlspecialchars($inserted_casual->phone_no, ENT_QUOTES, 'UTF-8'); ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="alt_phone_no">Alternate Phone Number:</label>
                            <input type="tel" id="alt_phone_no" name="alt_phone_no" value='<?php if (isset($inserted_casual->alt_phone_no)) echo htmlspecialchars($inserted_casual->alt_phone_no, ENT_QUOTES, 'UTF-8'); else { echo '[null]';} ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <input id="comment" name="comment" value='<?php if (isset($inserted_casual->comment)) echo htmlspecialchars($inserted_casual->comment, ENT_QUOTES, 'UTF-8'); else { echo '[null]';} ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="kcse_results">KCSE Results:</label>
                            <input type="text" id="kcse_results" name="kcse_results" value='<?php if (isset($inserted_casual->kcse_results_name)) echo htmlspecialchars($inserted_casual->kcse_results_name, ENT_QUOTES, 'UTF-8'); else { echo '[null]';} ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification:</label>
                            <input type="text" id="qualification" name="qualification" value='<?php if (isset($inserted_casual->qualification_name)) echo htmlspecialchars($inserted_casual->qualification_name, ENT_QUOTES, 'UTF-8'); else { echo '[null]';} ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="institution">Institution:</label>
                            <input type="text" id="institution" name="institution" value='<?php if (isset($inserted_casual->institution_name)) echo htmlspecialchars($inserted_casual->institution_name, ENT_QUOTES, 'UTF-8'); else { echo '[null]';} ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="specialization">Specialization:</label>
                            <input type="text" id="specialization" name="specialization" value='<?php if (isset($inserted_casual->specialization)) echo htmlspecialchars($inserted_casual->specialization, ENT_QUOTES, 'UTF-8'); else { echo '[null]';} ?>' readonly>
                        </div>
                     
                    </form>
                </div>

            </form>
        </div>
    </div>
</div>

<script> 
// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the close button, close the modal
span.onclick = function() {
    modal.style.display = "none";
    window.location.href = "<?php echo URL; ?>casuals/addCasual";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

// Function to open the modal
function openModal() {
    modal.style.display = "block";
}

</script>

    
</body>
</html>
<?php
 include APP . 'sessions/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Casual Staff Database</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />

<link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css"/>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>   
<!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    
    <nav style=" display: flex; justify-content: space-between; align-items:center;">
   
    <?php
if (isset($_SESSION['role']) && $_SESSION['role'] === "1") {
    ?>
      <div class="admin-nav" >
     <p>Master Casual Staff DB</p>
   
<a href="<?php echo URL; ?>casuals/filter" >Find casual</a>
<a href="<?php echo URL; ?>casuals/addCasual" >New casual</a>
<a href="<?php echo URL; ?>casuals/insertReturnCasual" >Return casual</a>
<a href="<?php echo URL; ?>casuals/dashboard" >Dashboard</a>
     </div>

    <div class="admin-hamburger">
    <p>Master Casual Staff DB</p>

    <span class="material-symbols-outlined">menu</span>
    <ul class="nav-menu-links">
    <a href="<?php echo URL; ?>casuals/filter" >Find casual</a>
    <a href="<?php echo URL; ?>casuals/addCasual" >New casual</a>
    <a href="<?php echo URL; ?>casuals/insertReturnCasual" >Return casual</a>
    </ul>
    </div>

 <?php } ?>

 <?php
if (isset($_SESSION['role']) && $_SESSION['role'] != "1") {
    ?>
        <div style=" display: flex; justify-content: space-between; align-items:center;">
        <p>Master Casual Staff DB</p> 
        <a style="padding:0.5rem;  color:#ffb9ef; margin-left:1rem;" href="<?php echo URL; ?>casuals/filter" >Find casual</a>
        <a style="padding:0.5rem;  color:#ffb9ef; margin-left:1rem;" href="<?php echo URL; ?>casuals/dashboard" >Dashboard</a>
        </div>
       
  <?php } ?>
       <a style="padding:0.5rem; background-color:#ddd; color:#20253A; margin-right:1rem; border-radius:10%;" href="<?php echo URL; ?>users/logout" 

>LOGOUT</a>
    </nav>

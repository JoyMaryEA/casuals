<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
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
    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    <!-- logo -->
    <!-- <div class="logo">
        MINI
    </div> -->

    <!-- navigation -->
    <!-- <div class="navigation">
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL; ?>home/exampleone">subpage</a>
        <a href="<?php echo URL; ?>home/exampletwo">subpage 2</a>
        <a href="<?php echo URL; ?>songs">songs</a>
    </div> -->
    <nav style=" display: flex; justify-content: space-between; align-items:center;">
    
     <div style=" display: flex; justify-content: space-between; align-items:center;">
     <p>Master Casual Staff DB</p>
     <a style="padding:0.5rem;  color:#f2c5e4; margin-left:1rem;" href="<?php echo URL; ?>casuals/addCasual" 

>Add Casual</a>
<a style="padding:0.5rem;  color:#f2c5e4; margin-left:1rem;" href="<?php echo URL; ?>casuals/filter" 

>Search</a>
     </div>
        
       <a style="padding:0.5rem; background-color:#ddd; color:#20253A; margin-right:1rem; border-radius:10%;" href="<?php echo URL; ?>users/logout" 

>LOGOUT</a>
    </nav>
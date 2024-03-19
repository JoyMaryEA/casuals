
<div class="left-nav">
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] === "1") {
    ?>
<ul>
<li> <a href="<?php echo URL; ?>casuals/dashboard" >Dashboard</a></li>
<li> <a href="<?php echo URL; ?>casuals/addCasual" >New Casual</a></li>
<li> <a href="<?php echo URL; ?>casuals/search" >Search Casual</a></li>
   <li><a href="<?php echo URL; ?>casuals/filter" >Filter Casuals</a></li>
   <li> <a href="<?php echo URL; ?>bulkProcessing/home" >Bulk Inserts</a></li>
</ul>
<?php } else {?>
    <ul>
    <li> <a href="<?php echo URL; ?>casuals/dashboard" >Dashboard</a></li>
    <li> <a href="<?php echo URL; ?>casuals/search" >Search Casual</a></li>
    <li><a href="<?php echo URL; ?>casuals/filter" >Filter Casuals</a></li>
   

   </ul>
<?php } ?>
</div>

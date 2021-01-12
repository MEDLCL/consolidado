<?php
ob_start();
session_start();

if (!$_SESSION['nombre']) {
    header('LOCATION: ../index.php');
} else {

    require_once("../inc/head.php");
    require_once("../inc/header.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- <div class="container"> -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
require_once("../inc/footer.php");
require_once("../inc/scritps.php");
?>

<?php }
ob_end_flush();
?>
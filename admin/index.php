<?php 
ob_start();
session_start(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <title>Admin - Dashboard</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <h1 class="display-4">Dashboard</h1>
                                <p class="muted">Make sure to update Admin database regularly!</p>
                                <p>Make sure to LOGOUT every time you leave the page.</p>
                        </div>
                        <!-- /.container-fluid -->
        <?php include_once("PartialViews/admin_footer.php") ?>

</body>

</html>

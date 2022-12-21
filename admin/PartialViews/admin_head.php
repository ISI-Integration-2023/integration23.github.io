<?php 
include_once('/user1/others/integration/public_html/config.php');
if (isset($_SESSION['adminname'])) {
    if (isset($_SESSION['password'])) {
        if ($_SESSION['adminname'] == $ADMIN_USER && $_SESSION['password'] == $ADMIN_PASS) {
      }
      else {
          header('Location: login.php');
      }
    }
}

else {
    header('Location: login.php');
}

?>



        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="admin-panel" />
        <meta name="author" content="subroy13" />

        
        <!-- Custom fonts for this template-->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

        <!-- Page level plugin CSS-->
        <link href="./assets/datatables/dataTables.bootstrap4.css" rel="stylesheet" />

        <!-- Custom styles for this template-->
        <link href="./assets/css/sb-admin.css" rel="stylesheet" />

        <!-- Bootstrap core JavaScript-->
        <script src="./assets/jquery/jquery.min.js"></script>
        <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="./assets/jquery-easing/jquery.easing.min.js"></script>

        <!-- Page level plugin JavaScript-->
        <script src="./assets/datatables/jquery.dataTables.js"></script>
        <script src="./assets/datatables/dataTables.bootstrap4.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="./assets/js/sb-admin.js"></script>

        <script src="./assets/js/datatables-demo.js"></script>


<link rel="stylesheet" href="./assets/css/jquery-confirm.min.css">
<script src="./assets/js/jquery-confirm.min.js"></script> 
<style>
    form .error { color: #ff0000;}
    em{color:#ff0000;}
    .img_contain{ border:1px solid #808080; margin:10px; padding:12px;}
    .back_div{ text-align:right;}
    .tbldatas tr td { padding:5px;}
    .cellcontent {
        max-width: 300px;
        max-height: 150px;
       overflow: scroll;
    }
</style>



    <!-- special css & scripts -->
    <link rel="stylesheet" href="./assets/css/bootstrap-switch.css" />

    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/bootstrap-switch.min.js"></script>
  



<script>
var RootPathHost = '<?php echo($HTTP_HOST); ?>';
</script>

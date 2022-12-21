<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Event Registration</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <h1 class="display-4">Event Registration Data Table</h1>

                                <!-- dynamic section start -->
                                <?php
                                require_once('../Model/eventdata_model.php');
                                require_once('../DAL/eventdata_dal.php');
        
                                $obj = new eventdata_dal(); 
                                $model = new eventdata_model();
                                $eventAll = $obj->getAll();  
                                ?>
                                
                                <div class="card mb-3">
                                <div class="card-header">
                                        <form action="#" class="form-horizontal" id="formeventregistration">
                                        <div class="form-group">
                                        <label class="control-label col-lg-4"> Event Name </label>                        
                                                <div class="col-lg-4">
                                                        <select name="eventid" id="eventid" class="form-control">
                                                                        <?php foreach ($eventAll as $item) { ?>
                                                                                        <option value="<?php echo($item->eventid) ?>"><?php echo($item->eventname) ?></option>
                                                                        <?php  } ?>
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="form-action no-margin-bottom" style="text-align:center;">
                                                <input type="submit" id="btnExecuteEvent" value="Submit" class="btn btn-primary btn-lg " />
                                        </div>

                                        </form>
                                </div>
                                </div>
                                

                                <div class="card mb-3">
                                        <div class="card-header">
                                                <i class="fas fa-table"></i>
                                                Data Table</div>
                                        <div class="card-body" id = "reg_result"></div>
                                        <!-- dynamic section end -->
                                        <div class="card-footer small text-muted">That's it!</div>
                                </div>

                        </div>
                        <!-- /.container-fluid -->

        <?php include_once("PartialViews/admin_footer.php") ?>

<!-- page level scripts -->
<script>      
      $(document).ready(function () {
		var RootPathHost = '<?php echo($HTTP_HOST);?>'

          $('#btnExecuteEvent').click(function(e){
                    e.preventDefault();
                    var formElement = document.querySelector("#formeventregistration");
                    var formData = new FormData(formElement);
                    formData.append("mode","getEventRegistration");
                    $.ajax({
                        url: 'https://www.isical.ac.in/~integration/admin/Controllers/event_registration_controller.php',
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: "POST",
                        success: function (data) {
                                //console.log(data);
                                $('#reg_result').html(data);
                        },
                        error: function (data) {
                        }
                    });//.End of Ajax
          });
          
          $(document).on('click','.approval-btn', function(e) {
                e.preventDefault();
                var userregid = parseInt($(this).attr("userreg-target"));
                var approval_status = "false";
                if ($(this).text() == "Disapprove") {
                        approval_status = "true";
                }
                var formData = new FormData();
                formData.append("userregid", userregid);
                formData.append("approval_status", approval_status);
                formData.append("mode","approval");
                
                //for (var pair of formData.entries()) {
                //        console.log(pair[0]+ ', ' + pair[1]); 
                //}

                //console.log($(this).text());
                
                $.ajax({
                        url: 'https://www.isical.ac.in/~integration/admin/Controllers/event_registration_controller.php',
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: "POST",
                        success: function (data) {
                                $.alert({
                                       title: "Action completed!",
                                       content: "Click ok.",
                                       buttons: {
                                               OK: function() {
                                                }
                                        }
                                });
                        },
                        error: function (data) {
                        }
                    });
                
                
          });
      });
  </script>
  


</body>

</html>

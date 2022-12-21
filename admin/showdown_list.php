<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Showdown</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <h1 class="display-4">Showdown Data Table</h1>

                                <!-- dynamic section start -->
                                <?php
                                require_once('../Model/showdown_model.php');
                                require_once('../DAL/showdown_dal.php');
        
                                $obj = new showdown_dal(); 
                                $model = new showdown_model();
                                $dataAll = $obj->getAll();  
                                ?>

                                <div class="card mb-3">
                                        <div class="card-header">
                                                <i class="fas fa-table"></i>
                                                Data Table</div>
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%"
                                                                cellspacing="0">
                                                                <thead>
                                                                <tr>
                                                                        <th style="width:10%">Showdown Id</th>
                                                                        <th style="width:10%">Showdown Name</th>
                                                                        <th style="width:20%">Description</th>
                                                                        <th style="width:15%">Time Venue</th>
                                                                        <th style="width:15%">Image Path</th>
                                                                        <th style="width:20%">Image</th>
                                                                        <th style="width:10%">Action</th>
                                                                </tr>
                                                               </thead>

                                                               <?php if($dataAll != null && count($dataAll) > 0){  ?>
                                                               <tbody>
                                                                       <?php 
                                                                        foreach ($dataAll as $item ) { ?>
                                                                                <tr style = "height: 25px">
                                                                                <td><?php echo($item->showdownid) ?> </td>
                                                                                <td><?php echo($item->showdownname) ?> </td>
                                                                                <td><div style="height:200px; overflow:hidden"><?php echo($item->description) ?> </div></td>
                                                                                <td><?php echo($item->timevenue) ?> </td>                
                                                                                <td><?php echo($item->posterimagepath) ?> </td>
                                                                                <td>
                                                                                        <img src="<?php echo($HTTP_HOST);?>/AppData/Showdowns/<?php echo($item->posterimagepath) ?>" height="200px"/> 
                                                                                </td>
                                                                                <td>
                                                                                        <a href="../admin/showdown_addedit.php?id=<?php echo($item->showdownid) ?>" >Edit</a> 
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                                        <a href="javascript:void(0)" class="delete_row" data-showdownid="<?php echo($item->showdownid) ?>">Delete</a>
                                                                                </td>
                                                                                </tr>
                                                                        <?php } ?>

                                                               </tbody>
                                                               <?php } ?>
                                                        </table>
                                                </div>
                                        </div>
                                        <!-- dynamic section end -->
                                        <div class="card-footer small text-muted">That's it!</div>
                                </div>

                        </div>
                        <!-- /.container-fluid -->

        <?php include_once("PartialViews/admin_footer.php") ?>

<!-- page level scripts -->
<script>      
      $(document).ready(function () {
          
          $('.delete_row').click(function (e) {
              e.preventDefault();

              var showdownid = $(this).attr("data-showdownid");
              var elemtr = $($(this).closest("tr"));

              $.confirm({
                  title: 'Message',
                  content: 'Do you want to delete Showdown with showdownid = ' + showdownid + ' ?',
                  buttons: {
                      "Yes": {
                          text: 'Yes',
                          btnClass: 'btn-default terms_agree',
                          action: function () {
                              var formData = new FormData();
                              formData.append("mode", "deleteshowdown");
                              formData.append("showdownid", showdownid);
                              $.ajax({
                                  url: RootPathHost+'/admin/Controllers/showdown_controller.php',
                                  enctype: 'multipart/form-data',
                                  data: formData,
                                  processData: false,
                                  contentType: false,
                                  type: "POST",
                                  success: function (data) {
                                      //alert(data)
                                      var arr = data.split("||||");
                                      var retval = arr[arr.length - 1];
                                      if (parseInt(retval) > 0) {
                                          elemtr.remove();
                                      } else {
                                          $.alert({
                                              title: 'Message',
                                              content: data,
                                              OK: function () {
                                              }
                                          });
                                      }
                                  },
                                  error: function (data) {
                                  }
                              });
                              //=============================
                          },
                          isDisabled: false
                      },
                      "No": {
                          text: 'No',
                          btnClass: 'btn-default terms_agree ',
                          action: function () {
                          },
                          isDisabled: false
                      }
                  }
              });
          })
      });
  </script>
  


</body>

</html>

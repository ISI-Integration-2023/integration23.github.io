<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Event</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <h1 class="display-4">Event Data Table</h1>

                                <!-- dynamic section start -->
                                <?php
                                require_once('../Model/eventdata_model.php');
                                require_once('../DAL/eventdata_dal.php');
        
                                $obj = new eventdata_dal(); 
                                $model = new eventdata_model();
                                $dataAll = $obj->getAllwithCategory();  
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
                                                                        <th style="width:5%">ID</th>
                                                                        <th style="width:10%">Event Name</th>
                                                                        <th style="width:10%">Category Name</th>
                                                                        <th style="width:10%">Description</th>
                                                                        <th style="width:15%">Event Head</th>
                                                                        <th style="width:10%">Fees Link</th>
                                                                        <th style="width:20%">Image</th>
                                                                        <th style="width:10%">Event Type</th>
                                                                        <th style="width:10%">Action</th>
                                                                </tr>
                                                               </thead>

                                                               <?php if($dataAll != null && count($dataAll) > 0){  ?>
                                                               <tbody>
                                                                       <?php 
                                                                        foreach ($dataAll as $item ) { ?>
                                                                                <tr>
                                                                                <td><?php echo($item->eventid) ?> </td>
                                                                                <td><?php echo($item->eventname) ?> </td>
                                                                                <td><?php echo($item->catname) ?></td>
                                                                                <td><div style="height:200px; overflow:hidden"><?php echo($item->description) ?> </div> </td>
                                                                                <td><?php echo($item->eventhead) ?> </td>
                                                                                <td><a href="<?php echo($item->fees)?>" target = "_blank">Link</a></td>
                                                                                <td>
                                                                                        <img src="<?php echo($HTTP_HOST);?>/AppData/Events/<?php echo($item->imagepath) ?>" height="100" width="120" /> 
                                                                                </td>
                                                                                <td> <?php echo(($item->isactive==true)?"Offline":"Online") ?> </td>  
                                                                                <td>
                                                                                        <a href="../admin/event_addedit.php?id=<?php echo($item->eventid) ?>" >Edit</a> 
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                                        <a href="javascript:void(0)" class="delete_row" data-eventid="<?php echo($item->eventid) ?>">Delete</a>
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

              var eventid = $(this).attr("data-eventid");
              var elemtr = $($(this).closest("tr"));

              $.confirm({
                  title: 'Message',
                  content: 'Do you want to delete Event with id = ' + eventid + ' ?',
                  buttons: {
                      "Yes": {
                          text: 'Yes',
                          btnClass: 'btn-default terms_agree',
                          action: function () {
                              var formData = new FormData();
                              formData.append("mode", "deleteevent");
                              formData.append("eventid", eventid);
                              $.ajax({
                                  url: RootPathHost+'/admin/Controllers/event_controller.php',
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

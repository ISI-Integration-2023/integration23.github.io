<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Team</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <h1 class="display-4">Team Member Data Table</h1>

                                <!-- dynamic section start -->
                                <?php
                                require_once('../Model/team_member_model.php');
                                require_once('../DAL/team_member_dal.php');
        
                                $obj = new team_member_dal(); 
                                $model = new team_member_model();
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
                                                                        <th style="width:10%">Member Name</th>
                                                                        <th style="width:10%">Category Name</th>
                                                                        <th style="width:10%">Phone</th>
                                                                        <th style="width:15%">Mail</th>
                                                                        <th style="width:10%">Fb Link</th>
                                                                        <th style="width:20%">Image</th>
                                                                        <th style="width:10%">IsActive</th>
                                                                        <th style="width:15%">Action</th>
                                                                </tr>
                                                               </thead>

                                                               <?php if($dataAll != null && count($dataAll) > 0){  ?>
                                                               <tbody>
                                                                       <?php 
                                                                        foreach ($dataAll as $item ) { ?>
                                                                                <tr>
                                                                                <td><?php echo($item->name) ?> </td>
                                                                                <td><?php echo($item->catname) ?></td>
                                                                                <td><?php echo($item->phone) ?> </td>
                                                                                <td><?php echo($item->email) ?> </td>
                                                                                <td><a href="<?php echo($item->fblink)?>" target = "_blank">Link</a></td>
                                                                                <td>
                                                                                        <img src="<?php echo($HTTP_HOST);?>/AppData/Team/<?php echo($item->imagepath) ?>" height="100" width="120" /> 
                                                                                </td>
                                                                                <td> <?php echo(($item->isactive==true)?"Active":"Inactive") ?> </td>  
                                                                                <td>
                                                                                        <a href="../admin/team_addedit.php?id=<?php echo($item->memberid) ?>" >Edit</a> 
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                                        <a href="javascript:void(0)" class="delete_row" data-memberid="<?php echo($item->memberid) ?>">Delete</a>
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

              var memberid = $(this).attr("data-memberid");
              var elemtr = $($(this).closest("tr"));

              $.confirm({
                  title: 'Message',
                  content: 'Do you want to delete Member with id = ' + memberid + ' ?',
                  buttons: {
                      "Yes": {
                          text: 'Yes',
                          btnClass: 'btn-default terms_agree',
                          action: function () {
                              var formData = new FormData();
                              formData.append("mode", "deletemember");
                              formData.append("memberid", memberid);
                              $.ajax({
                                  url: RootPathHost+'/admin/Controllers/team_controller.php',
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

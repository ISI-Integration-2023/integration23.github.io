<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Category</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <h1 class="display-4">Category Data Table</h1>

                                <!-- dynamic section start -->
                                <?php
                                require_once('../Model/category_model.php');
                                require_once('../DAL/category_dal.php');
        
                                $obj = new category_dal(); 
                                $model = new category_model();
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
                                                                        <th style="width:10%">Category Id</th>
                                                                        <th style="width:15%">Category Name</th>
                                                                        <th style="width:15%">Image Path</th>
                                                                        <th style="width:25%">Image</th>
                                                                        <th style="width:10%">IsActive</th>
                                                                        <th style="width:15%">Action</th>
                                                                </tr>
                                                               </thead>

                                                               <?php if($dataAll != null && count($dataAll) > 0){  ?>
                                                               <tbody>
                                                                       <?php 
                                                                        foreach ($dataAll as $item ) { ?>
                                                                                <tr>
                                                                                <td><?php echo($item->categoryid) ?> </td>
                                                                                <td><?php echo($item->categoryname) ?> </td>
                                                                                <td><?php echo($item->imagepath) ?> </td>
                                                                                <td>
                                                                                        <img src="<?php echo($HTTP_HOST);?>/AppData/Categories/<?php echo($item->imagepath) ?>" height="100" width="120" /> 
                                                                                </td>
                                                                                <td> <?php echo(($item->isactive==true)?"Active":"Inactive") ?> </td>  
                                                                                <td>
                                                                                        <a href="../admin/category_addedit.php?id=<?php echo($item->categoryid) ?>" >Edit</a> 
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                                        <a href="javascript:void(0)" class="delete_row" data-categoryid="<?php echo($item->categoryid) ?>">Delete</a>
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

              var categoryid = $(this).attr("data-categoryid");
              var elemtr = $($(this).closest("tr"));

              $.confirm({
                  title: 'Message',
                  content: 'Do you want to delete category with categoryid = ' + categoryid + ' ?',
                  buttons: {
                      "Yes": {
                          text: 'Yes',
                          btnClass: 'btn-default terms_agree',
                          action: function () {
                              var formData = new FormData();
                              formData.append("mode", "deletecategory");
                              formData.append("categoryid", categoryid);
                              $.ajax({
                                  url: RootPathHost+'/admin/Controllers/category_controller.php',
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

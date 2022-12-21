<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Sponsor</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <!-- dynamic section start -->
                                <?php  $sponsorid = 0;
                                if (isset($_REQUEST['id'])){
                                        if(!empty($_REQUEST['id'])){
                                                $sponsorid = $_REQUEST['id'];// query string had param set to nothing ie ?param=&param2=something
                                        }
                                }
                                ?>

                                <h1 class="display-4"><?php  echo(($sponsorid==0)?"Add":"Edit")?> Sponsor Data</h1>
                                
                                <?php
                                require_once($ROOT_PATH.'/Model/sponsor_model.php');
                                require_once($ROOT_PATH.'/DAL/sponsor_dal.php');
                                
                                $obj = new sponsor_dal(); 
                                $model = new sponsor_model();
                                if($sponsorid>0){
                                        $list = $obj->getDatas(' sponsorid= '.$sponsorid);
                                        $model = reset($list); 
                                }
                                ?>

                                <div class="card mb-3">
                                        <div class="card-body">
                                                <form action="#" class="form-horizontal" id="formsponsor">
                               
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Sponsor ID<em>*</em></label>
                                                        <div class="col-lg-4">
                                                        <input type="text" name="sponsorid" id="sponsorid" value="<?php echo($model->sponsorid)?>" placeholder="Sponsor ID" readonly class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Sponsor Name<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="sponsorname" id="sponsorname" value="<?php echo($model->sponsorname)?>"  placeholder="Sponsor Name" class="form-control"/>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Logo Image Path<em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <input type="text" name="sponsorimgname" id="sponsorimgname" value="<?php echo($model->logoimagepath)?>" placeholder="Sponsor Logo Image Name" readonly class="form-control"/>
                                                        </div>
                                                </div>
                                                                        
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Logo Image<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type='file' id="imgFile" name="imgFile" />
                                                                <div id='img_contain' class="img_contain">
                                                                <?php if($model->logoimagepath==null || $model->logoimagepath==""){ ?>
                                                                        <img id="imgElem" src="../AppData/Images/no-image.png" alt="your image" title='' height="180" width="150"/>
                                                                <?php }  else { ?>
                                                                        <img id="imgElem" src="../AppData/Sponsors/<?php echo($model->logoimagepath)?>" alt="your image" title='' height="180" width="150"/>
                                                                        <?php } ?>

                                                                        <?php if($sponsorid>0){ ?>
                                                                        <input type="button" value="Update Image" id="btnUpdateImage" />
                                                                <?php } ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                
                                                <br />
                                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                                <input type="submit" id="btnSaveSponsor" value="Save" class="btn btn-primary btn-lg " />
                                                <a href="../admin/sponsor_list.php" id="btnCancel" class="btn btn-default btn-lg" >Cancel</a>
                                                </div>

                                                </form>
  
                                        </div>
                                </div>

                                <!-- dynamic section end -->
                                

                        </div>
                        <!-- /.container-fluid -->

        <?php include_once("PartialViews/admin_footer.php") ?>

<!-- page level scripts -->
<script>


      $(document).ready(function () {
          

          $("#formsponsor").validate({
              rules: {
                  sponsorname: "required"
              },
              // Specify validation error messages
              messages: {
                  sponsorname: "Please enter Sponsor Name"
              },
              submitHandler: function (form) {
                  form.submit();
              }
          });

          function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      $('#imgElem').attr('src', e.target.result);
                      $('#imgElem').hide();
                      $('#imgElem').fadeIn(1000);
                  }
                  reader.readAsDataURL(input.files[0]);
              }
          }
          $("#imgFile").change(function () {
              readURL(this);
          });

          $('#btnSaveSponsor').click(function (e) {

              var ret = $('#formsponsor').valid();
              e.preventDefault();
              if (ret) {
                  var formElement = document.querySelector("#formsponsor");
                  var formData = new FormData(formElement);
                  formData.append("mode", "addedit");

                  $.ajax({
                      url: RootPathHost+'/admin/Controllers/sponsor_controller.php',
                      enctype: 'multipart/form-data',
                      data: formData,
                      processData: false,
                      contentType: false,
                      type: "POST",
                      success: function (data) {
                          var arr = data.split("||||");
                          var retval = arr[arr.length - 1];
                          if (retval > 0) {
                              $('#sponsorid').val("" + retval);
                              $.alert({
                                  title: 'Message',
                                  content: 'Successfully saved',
                                  OK: function () {
                                  }
                              });

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
              }
          });

          $('#btnUpdateImage').click(function (e) {

              var ret = true; //$('#formcategory').valid();
              e.preventDefault();
              if (ret) {
                  var formElement = document.querySelector("#formsponsor");
                  var formData = new FormData(formElement);
                  formData.append("mode", "updateimage");

                  $.confirm({
                      title: 'Message',
                      content: 'Do you want to change the image?',
                      buttons: {
                          "Yes": {
                              text: 'Yes',
                              btnClass: 'btn-default terms_agree',
                              action: function () {
                                  $.ajax({
                                      url: RootPathHost+'/admin/Controllers/sponsor_controller.php',
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
                                              $.alert({
                                                  title: 'Message',
                                                  content: 'Successfully saved',
                                                  OK: function () {
                                                      location.reload();
                                                  }
                                              });
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


              }
          });

      })

  </script>



</body>

</html>
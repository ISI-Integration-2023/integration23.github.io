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

                                <!-- dynamic section start -->
                                <?php  $showdownid = 0;
                                if (isset($_REQUEST['id'])){
                                        if(!empty($_REQUEST['id'])){
                                                $showdownid = $_REQUEST['id'];// query string had param set to nothing ie ?param=&param2=something
                                        }
                                }
                                ?>

                                <h1 class="display-4"><?php  echo(($showdownid==0)?"Add":"Edit")?> Showdown Data</h1>
                                
                                <?php
                                require_once($ROOT_PATH.'/Model/showdown_model.php');
                                require_once($ROOT_PATH.'/DAL/showdown_dal.php');
                                
                                $obj = new showdown_dal(); 
                                $model = new showdown_model();
                                if($showdownid>0){
                                        $list = $obj->getDatas(' showdownid= '.$showdownid);
                                        $model = reset($list); 
                                }
                                ?>

                                <div class="card mb-3">
                                        <div class="card-body">
                                                <form action="#" class="form-horizontal" id="formshowdown">
                               
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Showdown ID<em>*</em></label>
                                                        <div class="col-lg-4">
                                                        <input type="text" name="showdownid" id="showdownid" value="<?php echo($model->showdownid)?>" placeholder="Showdown ID" readonly class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Showdown Name<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="showdownname" id="showdownname" value="<?php echo($model->showdownname)?>"  placeholder="Showdown Name" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Showdown Description<em>*</em></label>
                                                        <div class="col-lg-12">
                                                                <textarea  id="description" name="description" rows="10" cols="70"><?php echo($model->description)?></textarea>  
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Time & Venue</label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="timevenue" id="timevenue" value="<?php echo($model->timevenue)?>"  placeholder="Showdown Time and Venue" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Showdown Image Path<em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <input type="text" name="showdownimgname" id="showdownimgname" value="<?php echo($model->posterimagepath)?>" placeholder="Showdown Poster Image name" readonly class="form-control"/>
                                                        </div>
                                                </div>
                                                                        
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Poster Image<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type='file' id="imgFile" name="imgFile" />
                                                                <div id='img_contain' class="img_contain">
                                                                <?php if($model->posterimagepath==null || $model->posterimagepath==""){ ?>
                                                                        <img id="imgElem" src="../AppData/Images/no-image.png" alt="your image" title='' height="180" width="150"/>
                                                                <?php }  else { ?>
                                                                        <img id="imgElem" src="../AppData/Showdowns/<?php echo($model->posterimagepath)?>" alt="your image" title='' height="180" width="150"/>
                                                                        <?php } ?>

                                                                        <?php if($showdownid>0){ ?>
                                                                        <input type="button" value="Update Image" id="btnUpdateImage" />
                                                                <?php } ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                
                                                <br />
                                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                                <input type="submit" id="btnSaveShowdown" value="Save" class="btn btn-primary btn-lg " />
                                                <a href="../admin/showdown_list.php" id="btnCancel" class="btn btn-default btn-lg" >Cancel</a>
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
          

          $("#formshowdown").validate({
              rules: {
                  showdownname: "required"
              },
              // Specify validation error messages
              messages: {
                  showdownname: "Please enter Showdown Name"
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

          $('#btnSaveShowdown').click(function (e) {

              var ret = $('#formshowdown').valid();
              e.preventDefault();
              if (ret) {
                  var formElement = document.querySelector("#formshowdown");
                  var formData = new FormData(formElement);
                  formData.append("mode", "addedit");

                  $.ajax({
                      url: RootPathHost+'/admin/Controllers/showdown_controller.php',
                      enctype: 'multipart/form-data',
                      data: formData,
                      processData: false,
                      contentType: false,
                      type: "POST",
                      success: function (data) {
                          var arr = data.split("||||");
                          var retval = arr[arr.length - 1];
                          if (retval > 0) {
                              $('#showdownid').val("" + retval);
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
                  var formElement = document.querySelector("#formshowdown");
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
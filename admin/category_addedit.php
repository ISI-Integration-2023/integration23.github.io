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

                                <!-- dynamic section start -->
                                <?php  $categoryid = 0;
                                if (isset($_REQUEST['id'])){
                                        if(!empty($_REQUEST['id'])){
                                                $categoryid = $_REQUEST['id'];// query string had param set to nothing ie ?param=&param2=something
                                        }
                                }
                                ?>

                                <h1 class="display-4"><?php  echo(($categoryid==0)?"Add":"Edit")?> Category Data</h1>
                                
                                <?php
                                require_once($ROOT_PATH.'/Model/category_model.php');
                                require_once($ROOT_PATH.'/DAL/category_dal.php');
                                
                                $obj = new category_dal(); 
                                $model = new category_model();
                                $model->isactive = true;
                                $model->isevent =  false;
                                if($categoryid>0){
                                        $list = $obj->getDatas(' categoryid= '.$categoryid);
                                        $model = reset($list); 
                                }
                                ?>

                                <div class="card mb-3">
                                        <div class="card-body">
                                                <form action="#" class="form-horizontal" id="formcategory">
                               
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Category ID<em>*</em></label>
                                                        <div class="col-lg-4">
                                                        <input type="text" name="categoryid" id="categoryid" value="<?php echo($model->categoryid)?>" placeholder="Category ID" readonly class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Category Name<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="categoryname" id="categoryname" value="<?php echo($model->categoryname)?>"  placeholder="Category Name" class="form-control"/>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Category Description<em>*</em></label>
                                                        <div class="col-lg-12">
                                                                <textarea  id="description" name="description" rows="10" cols="70"><?php echo($model->description)?></textarea>  
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Image Path<em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <input type="text" name="categoryimgname" id="categoryimgname" value="<?php echo($model->imagepath)?>" placeholder="Category Image Name" readonly class="form-control"/>
                                                        </div>
                                                </div>
                                                                        
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Image<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type='file' id="imgFile" name="imgFile" />
                                                                <div id='img_contain' class="img_contain">
                                                                <?php if($model->imagepath==null || $model->imagepath==""){ ?>
                                                                        <img id="imgElem" src="../AppData/Images/no-image.png" alt="your image" title='' height="180" width="150"/>
                                                                <?php }  else { ?>
                                                                        <img id="imgElem" src="../AppData/Categories/<?php echo($model->imagepath)?>" alt="your image" title='' height="180" width="150"/>
                                                                        <?php } ?>

                                                                        <?php if($categoryid>0){ ?>
                                                                        <input type="button" value="Update Image" id="btnUpdateImage" />
                                                                <?php } ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Is Active ? <em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <div class="make-switch switch-large">
                                                                <input type="checkbox"  id="isactive" name="isactive" <?php echo (($model->isactive == true)?"value='1'  checked='checked'":" value='0' ") ?> onchange="this.value=1-this.value"/>
                                                                </div>
                                                        </div>
                                                </div>
                                                <br />
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Is Event ? <em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <div class="make-switch switch-large">
                                                                <input type="checkbox"  id="isevent" name="isevent"  <?php echo (($model->isevent == true)?"value='1'  checked='checked'":" value='0' ") ?> onchange="this.value=1-this.value"/>
                                                                </div>
                                                        </div>
                                                </div>
                                                <br />
                                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                                <input type="submit" id="btnSavecategory" value="Save" class="btn btn-primary btn-lg " />
                                                <a href="../admin/category_list.php" id="btnCancel" class="btn btn-default btn-lg" >Cancel</a>
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
          

          $("#formcategory").validate({
              rules: {
                  categoryname: "required",
                  description: "required"
              },
              // Specify validation error messages
              messages: {
                  categoryname: "Please enter Category Name",
                  description: "Please enter Category Description"
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
                      $('#imgElem').fadeIn(650);
                  }
                  reader.readAsDataURL(input.files[0]);
              }
          }
          $("#imgFile").change(function () {
              readURL(this);
          });

          $('#btnSavecategory').click(function (e) {

              var ret = $('#formcategory').valid();
              e.preventDefault();
              if (ret) {
                  var formElement = document.querySelector("#formcategory");
                  var formData = new FormData(formElement);
                  formData.append("mode", "addedit");

                  $.ajax({
                      url: RootPathHost+'/admin/Controllers/category_controller.php',
                      enctype: 'multipart/form-data',
                      data: formData,
                      processData: false,
                      contentType: false,
                      type: "POST",
                      success: function (data) {
                          var arr = data.split("||||");
                          var retval = arr[arr.length - 1];
                          if (retval > 0) {
                              $('#categoryid').val("" + retval);
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
                  var formElement = document.querySelector("#formcategory");
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
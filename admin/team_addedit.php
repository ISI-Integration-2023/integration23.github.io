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

                                <!-- dynamic section start -->
                                <?php  $memberid = 0;
                                if (isset($_REQUEST['id'])){
                                        if(!empty($_REQUEST['id'])){
                                                $memberid = $_REQUEST['id'];// query string had param set to nothing ie ?param=&param2=something
                                        }
                                }
                                ?>

                                <h1 class="display-4"><?php  echo(($memberid==0)?"Add":"Edit")?> Member Data</h1>
                                
                                <?php
                                require_once($ROOT_PATH.'/Model/team_member_model.php');
                                require_once($ROOT_PATH.'/DAL/team_member_dal.php');
                                
                                $obj = new team_member_dal(); 
                                $model = new team_member_model();
                                if($memberid>0){
                                        $list = $obj->getDatas(' memberid= '.$memberid);
                                        $model = reset($list); 
                                }
                                ?>

                                <div class="card mb-3">
                                        <div class="card-body">
                                                <form action="#" class="form-horizontal" id="formteam">
                               
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Member ID<em>*</em></label>
                                                        <div class="col-lg-4">
                                                        <input type="text" name="memberid" id="memberid" value="<?php echo($model->memberid)?>" placeholder="Member ID" readonly class="form-control"/>
                                                        </div>
                                                </div>

                                                <?php
                                                        require_once($ROOT_PATH.'/Model/category_model.php');
                                                        require_once($ROOT_PATH.'/DAL/category_dal.php');
                                                        
                                                        $catobj = new category_dal(); 
                                                        //$catmodel = new category_model();
                                                        $allcat = $catobj->getAll();
                                                ?>

                                                
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Associated Category</label>                        
                                                        <div class="col-lg-4">
                                                                <select name="catid" id="catid" class="form-control">
                                                                        <?php foreach ($allcat as $item) { ?>
                                                                        <option value="<?php echo($item->categoryid) ?>"><?php echo($item->categoryname) ?></option>
                                                                        <?php } ?>
                                                                </select>
                                                        </div>
                                                </div>


                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Name<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="name" id="name" value="<?php echo($model->name)?>"  placeholder="Name" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Phone Number<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="phone" id="phone" value="<?php echo($model->phone)?>"  placeholder="Phone Number" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Email<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="email" id="email" value="<?php echo($model->email)?>"  placeholder="Email Address" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Link to Facebook Profile</label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="fblink" id="fblink" value="<?php echo($model->fblink)?>"  placeholder="Link" class="form-control"/>
                                                        </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Image Path<em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <input type="text" name="imagepath" id="imagepath" value="<?php echo($model->imagepath)?>" placeholder="Member Image Name" readonly class="form-control"/>
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
                                                                        <img id="imgElem" src="../AppData/Team/<?php echo($model->imagepath)?>" alt="your image" title='' height="180" width="150"/>
                                                                        <?php } ?>

                                                                        <?php if($memberid>0){ ?>
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
                                                

                                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                                <input type="submit" id="btnSaveteam" value="Save" class="btn btn-primary btn-lg " />
                                                <a href="../admin/team_list.php" id="btnCancel" class="btn btn-default btn-lg" >Cancel</a>
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
          
          $.validator.addMethod("EMAIL", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
            }, "Email Address is invalid: Please enter a valid email address.");

          $("#formteam").validate({
              rules: {
                  name : "required",
                  phone: "required",
                  email: "required EMAIL"
              },
              // Specify validation error messages
              messages: {
                 name: "Please enter team member's name",
                 phone: "Please enter a phone number"
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

          $('#btnSaveteam').click(function (e) {

              var ret = $('#formteam').valid();
              e.preventDefault();
              if (ret) {
                  var formElement = document.querySelector("#formteam");
                  var formData = new FormData(formElement);
                  formData.append("mode", "addedit");

                  $.ajax({
                      url: RootPathHost+'/admin/Controllers/team_controller.php',
                      enctype: 'multipart/form-data',
                      data: formData,
                      processData: false,
                      contentType: false,
                      type: "POST",
                      success: function (data) {
                          var arr = data.split("||||");
                          var retval = arr[arr.length - 1];
                          if (retval > 0) {
                              $('#memberid').val("" + retval);
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
                  var formElement = document.querySelector("#formteam");
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
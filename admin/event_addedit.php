<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Event</title>
        <?php include_once("PartialViews/admin_head.php") ?>
        <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">

                                <!-- dynamic section start -->
                                <?php  $eventid = 0;
                                if (isset($_REQUEST['id'])){
                                        if(!empty($_REQUEST['id'])){
                                                $eventid = $_REQUEST['id'];// query string had param set to nothing ie ?param=&param2=something
                                        }
                                }
                                ?>

                                <h1 class="display-4"><?php  echo(($eventid==0)?"Add":"Edit")?> Member Data</h1>
                                
                                <?php
                                require_once($ROOT_PATH.'/Model/eventdata_model.php');
                                require_once($ROOT_PATH.'/DAL/eventdata_dal.php');
                                
                                $obj = new eventdata_dal(); 
                                $model = new eventdata_model();
                                if($eventid>0){
                                        $list = $obj->getDatas(' eventid= '.$eventid);
                                        $model = reset($list); 
                                }
                                ?>

                                <div class="card mb-3">
                                        <div class="card-body">
                                                <form action="#" class="form-horizontal" id="formevent">
                               
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Event ID<em>*</em></label>
                                                        <div class="col-lg-4">
                                                        <input type="text" name="eventid" id="eventid" value="<?php echo($model->eventid)?>" placeholder="Member ID" readonly class="form-control"/>
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
                                                                        <?php foreach ($allcat as $item) { 
                                                                                if ($item->isevent) { ?>
                                                                                        <option value="<?php echo($item->categoryid) ?>"><?php echo($item->categoryname) ?></option>
                                                                        <?php } 
                                                                        } ?>
                                                                </select>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Event Name<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="eventname" id="eventname" value="<?php echo($model->eventname)?>"  placeholder="Name" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Event Short Description<em>*</em></label>
                                                        <div class="col-lg-12">
                                                                <textarea  id="description" name="description" rows="10" cols="70"><?php echo($model->description)?></textarea>  
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Event CMS Content<em>*</em></label>
                                                        <div class="col-lg-12">
                                                                <textarea  id="cmscontent" name="cmscontent" rows="10" cols="70"><?php echo($model->cmscontent)?></textarea>  
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Event Heads</label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="eventhead" id="eventhead" value="<?php echo($model->eventhead)?>"  placeholder="Event Head" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Time & Venue<em>*</em></label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="timevenue" id="timevenue" value="<?php echo($model->timevenue)?>"  placeholder="Time and Venue" class="form-control"/>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Fees</label>
                                                        <div class="col-lg-4">
                                                                <input type="text" name="fees" id="fees" value="<?php echo($model->fees)?>"  placeholder="fees" class="form-control"/>
                                                        </div>
                                                </div>



                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Image Path<em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <input type="text" name="imagepath" id="imagepath" value="<?php echo($model->imagepath)?>" placeholder="Event Image Name" readonly class="form-control"/>
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
                                                                        <img id="imgElem" src="../AppData/Events/<?php echo($model->imagepath)?>" alt="your image" title='' height="180" width="150"/>
                                                                        <?php } ?>

                                                                        <?php if($eventid>0){ ?>
                                                                        <input type="button" value="Update Image" id="btnUpdateImage" />
                                                                <?php } ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                        <label class="control-label col-lg-4">Is Offline Event ? <em>*</em></label>                        
                                                        <div class="col-lg-4">
                                                                <div class="make-switch switch-large">
                                                                <input type="checkbox"  id="isactive" name="isactive" <?php echo (($model->isactive == true)?"value='1'  checked='checked'":" value='0' ") ?> onchange="this.value=1-this.value"/>
                                                                </div>
                                                        </div>
                                                </div>
                                                

                                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                                <input type="submit" id="btnSaveEvent" value="Save" class="btn btn-primary btn-lg " />
                                                <a href="../admin/event_list.php" id="btnCancel" class="btn btn-default btn-lg" >Cancel</a>
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
        
        CKEDITOR.replace( 'cmscontent');
        
      $(document).ready(function () {
          
          $("#formevent").validate({
              rules: {
                  eventname: "required",
                  fees: "required"
              },
              // Specify validation error messages
              messages: {
                 eventname: "Please enter name of the event",
                 fees: "Please enter the fees"
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

          $('#btnSaveEvent').click(function (e) {
             for (instance in CKEDITOR.instances) { CKEDITOR.instances[instance].updateElement();  }

              var ret = $('#formevent').valid();
              e.preventDefault();
              if (ret) {
                  var formElement = document.querySelector("#formevent");
                  var formData = new FormData(formElement);
                  formData.append("mode", "addedit");

                  $.ajax({
                      url: RootPathHost+'/admin/Controllers/event_controller.php',
                      enctype: 'multipart/form-data',
                      data: formData,
                      processData: false,
                      contentType: false,
                      type: "POST",
                      success: function (data) {
                          var arr = data.split("||||");
                          var retval = arr[arr.length - 1];
                          if (retval > 0) {
                              $('#eventid').val("" + retval);
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
                  var formElement = document.querySelector("#formevent");
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
<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Admin - Query</title>
        <?php include_once("PartialViews/admin_head.php") ?>
</head>

<body id="page-top">
        <?php include_once("PartialViews/admin_navbar.php") ?>
        <div id="wrapper">
                <?php include_once("PartialViews/admin_sidebar.php") ?>
                <div id="content-wrapper">

                        <div class="container-fluid">
                                <h1 class="display-4">Execute MySQL Queries</h1>

                                <h2 class="text-muted">Example Query for selecting Columns</h2>
                                <pre>
                                        SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                        WHERE `TABLE_SCHEMA`='integrationdb' 
                                        AND `TABLE_NAME`='yourtablename';
                                </pre>
                                <hr/>


                                <!-- dynamic section start -->
                                <form action="#" class="form-horizontal" id="fromQuery">

                                <div class="form-group">
                                     <label>Query<em>*</em></label>
                                     <div class="row">
                                         <div class="col-8">
                                             <textarea  id="txtQuery" name="txtQuery" style="width:100%; height:100%"></textarea>  
                                         </div>
                                         
                                         <div class="col-4">
                                             <h3 class="text-muted">List of Available Tables</h3>
                                             <?php
                                             require_once( $ROOT_PATH.'/DAL/database.php');
                                             $dalobj = new DB();  
                                             $tblarr = $dalobj->ExecuteQuery('SHOW TABLES');
                                             echo "<table border='1' class='table table-bordered'>";
                                             foreach($tblarr as $key=>$row) { 
                                                 echo "<tr>";
                                                 foreach($row as $key2=>$row2){
                                                     echo "<td>" . $row2 . "</td>";
                                                 }
                                                 echo "</tr>";
                                             }
                                             echo "</table>";
                                             ?>
                                             
                                         </div>                                   
                                     </div>
                                </div>

                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                     <input type="submit" id="btnExecuteQuery" value="Execute Query" data-mode="executequery" class="submitform btn btn-primary btn-lg " />
                                     <input type="submit" id="btnExecuteNonQuery" value="Execute Non Query (For Insert / Update)" data-mode="executenonquery" class="submitform btn btn-primary btn-lg " />
                                </div>
                              </form>
                                <br /><br /><br />
                           <div id="dvresult" style="width:90%;overflow: scroll;max-height: 500px;"></div>
                            <br /><br /><br />
                        </div>
                        <!-- /.container-fluid -->

        <?php include_once("PartialViews/admin_footer.php") ?>


<!-- page level script -->
<script>
        $(document).ready(function () {

            $("#fromQuery").validate({
                rules: {
                    txtQuery: "required"
                },
                messages: {
                    txtQuery: "Please enter the query"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $('.submitform').click(function (e) {
                var ret = $('#fromQuery').valid();
                e.preventDefault();
                if (ret) {
                    var formElement = document.querySelector("#fromQuery");
                    var formData = new FormData(formElement);
                    formData.append("mode", $(this).attr("data-mode"));
                    $.ajax({
                        url: 'https://www.isical.ac.in/~integration/admin/Controllers/query_controller.php',
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: "POST",
                        success: function (data) {
                            console.log(data);
                            $('#dvresult').html(data);
                        },
                        error: function (data) {
                        }
                    });//.End of Ajax
                }
            })

        });
</script>
   

</body>

</html>

<?php
include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/DAL/database.php');

class query_controller
{
    static function Execute($modevalue){  
        $dalobj = new DB();  
        $query = "";
         if (isset($_REQUEST['txtQuery'])){  $query = $_REQUEST['txtQuery']; }  

        if($modevalue=="executequery"){
            $arr = $dalobj->ExecuteQuery($query);
            return $arr;
        }
        else if($modevalue=="executenonquery"){
            $noOfRowsEffected = $dalobj->ExecuteNonQuery($query); 
            return $noOfRowsEffected;
        }else{
            return "";
        }
    }

}
?>

<?php
$mode="";
if (isset($_REQUEST['mode']))
{
    if(!empty($_REQUEST['mode']))
    {
        $mode = $_REQUEST['mode'];
    }
}
if($mode=="executequery"){
    try {
        $retarray = query_controller::Execute("executequery");
        
        //var_dump($retarray);
        if( sizeof($retarray) > 0){
             
            $firstvalue = reset($retarray);
            //var_dump(array_keys($firstvalue));

              echo "<table class = 'table table-bordered'>";
              echo "<tr>";
              foreach(array_keys($firstvalue) as $key=>$row) { 
                  echo "<th>" . $row . "</th>"; 
              }
              echo "</tr>";

                  foreach($retarray as $key=>$row) {
                      echo "<tr>";
                      foreach($row as $key2=>$row2){
                          echo "<td>" . htmlspecialchars($row2) . "</td>";
                      }
                      echo "</tr>";
                  }
              echo "</table>";
          }else{
              echo "<span> 0 rows Selected </span>";
          }
               
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
}
else if($mode=="executenonquery"){
    try {
        $noOfRowsEffected = query_controller::Execute("executenonquery"); 
    
        echo("<h3> $noOfRowsEffected rows effected </h3>");
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
}


?>
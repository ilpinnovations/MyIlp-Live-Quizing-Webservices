<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$emp_id = $_GET['emp_id'];
$emp_email=$_GET['emp_email'];
$data = array();
if(isset($emp_id))
{
$query = "SELECT emp_id,emp_name,emp_email,emp_loc FROM emp_reg WHERE emp_id='$emp_id' AND emp_email='$emp_email'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows==1)
{
while($row = mysql_fetch_assoc($result))
{
$data= $row;
}
//header('content-type:application/json');
echo json_encode($data);
}
else{
$data=array(
"null_trigger"=>"User do not exist"
);
//header('content-type:application/json');
echo json_encode($data);
}

}
mysql_close($connection);
?>
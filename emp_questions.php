<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$emp_id = $_GET['emp_id'];
$data = array();
if(isset($emp_id))
{
	
$query = "SELECT * FROM ibuzquestions WHERE emp_id='$emp_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows>=1)
{
while($row = mysql_fetch_assoc($result))
{
$data[]= $row;
}
//header('content-type:application/json');
echo json_encode(array('data' =>$data));
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
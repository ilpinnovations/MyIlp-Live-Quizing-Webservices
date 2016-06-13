<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$data = array();
$faculty_id = $_GET['f_id'];
if(isset($faculty_id))
{
$query = "SELECT emp_id FROM emp_reg WHERE emp_id='$faculty_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows==1)
{
	$sql = "select emp_loc AS centre,count(emp_loc) AS count FROM emp_ans WHERE faculty_emp_id='$faculty_id' AND emp_loc='Trivandrum'";
$result = mysql_query($sql,$connection) or die("Error in Selecting " . mysql_error($connection));
$trivandrum_count = mysql_fetch_assoc($result);

$sql2 = "SELECT  emp_loc AS centre,count(emp_loc) AS count FROM emp_ans WHERE faculty_emp_id='$faculty_id' AND emp_loc='Hydrabad'";
$result2 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));
$hydrabad_count = mysql_fetch_assoc($result2);

$sql3 = "SELECT  emp_loc AS centre,count(emp_loc) AS count FROM emp_ans WHERE faculty_emp_id='$faculty_id' AND emp_loc='Chennai'";
$result3 = mysql_query($sql3,$connection) or die("Error in Selecting " . mysql_error($connection));
$chennai_count = mysql_fetch_assoc($result3);

$sql4 = "SELECT  emp_loc AS centre,count(emp_loc) AS count FROM emp_ans WHERE faculty_emp_id='$faculty_id' AND emp_loc='Ahemdabad'";
$result4 = mysql_query($sql4,$connection) or die("Error in Selecting " . mysql_error($connection));
$ahemdabad_count = mysql_fetch_assoc($result4);

$sql5 = "SELECT  emp_loc AS centre,count(emp_loc) AS count FROM emp_ans WHERE faculty_emp_id='$faculty_id' AND emp_loc='Guwahati'";
$result5 = mysql_query($sql5,$connection) or die("Error in Selecting " . mysql_error($connection));
$guwahati_count = mysql_fetch_assoc($result5);
$data=array(
$trivandrum_count,

$hydrabad_count,
$chennai_count,

$ahemdabad_count,

$guwahati_count
);
}
else
{
	$data[]=array(
"null_trigger"=>"Employee with this employee ID does not exist"
);
	}
//header('content-type:application/json');
echo json_encode(array('data' =>$data));
  
  
}
 mysql_close($connection);
?>
<?php

include_once('my_ilp_db.php'); 
$q_id = $_GET['q_id'];
$data = array();
if(isset($q_id))
{
$query = "SELECT ques_id FROM ibuzquestions WHERE ques_id='$q_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows==1)
{
$query2 = "SELECT views FROM ibuzquestions WHERE ques_id='$q_id'";
$result2 = mysql_query($query2,$connection);
$row2 = mysql_fetch_assoc($result2);
$views= $row2['views'];
$views +=1; 
$query2 = "UPDATE ibuzquestions SET views='$views' WHERE ques_id='$q_id'";
$result2 = mysql_query($query2,$connection);
$data=array(
"Success"=>"Count Increased by 1"
);
header('content-type:application/json');
echo json_encode($data);
}
else{
$data=array(
"null_trigger"=>"Question do not exist"
);
header('content-type:application/json');
echo json_encode($data);
}

}
mysql_close($connection);
?>
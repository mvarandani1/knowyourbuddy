<?php include '../includes/db.php'?>
<?php
$q_id=$_POST['q_no']+1;
$user_id=$_POST['user_id'];
$sql="Select * from usersq where Uid='$user_id' and Qid=$q_id";
$row=mysqli_fetch_assoc(mysqli_query($connection,$sql));
$question=$row['Question'];
$color=$row['color'];
$optionssql="Select * from usersoption where Uid='$user_id' and Qid=$q_id";
$getsql=mysqli_query($connection,$optionssql);
$options=[];
while($row=mysqli_fetch_assoc($getsql))
{
  $options[]=$row['options'];
}
$questionset=new stdClass();
$questionset->question=$question;
$questionset->options=$options
;

echo json_encode($questionset);
 ?>

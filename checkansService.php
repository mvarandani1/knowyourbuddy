<?php include '../includes/db.php'?>
<?php
$q_id=$_POST['q_no'];
$user_id=$_POST['user_id'];
$sql="Select * from usersans where Uid='$user_id' and Qid=$q_id ";
$execute=mysqli_query($connection,$sql);

$row=mysqli_fetch_assoc($execute);
$opt_id=$row['optid'];
$optsql="select options from usersoption where id=$opt_id";
$optans=mysqli_query($connection,$optsql);
$options=mysqli_fetch_assoc($optans);
echo json_encode($options['options']);

exit;
?>

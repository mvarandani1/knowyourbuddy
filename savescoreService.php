<?php include '../includes/db.php'?>
<?php
$user_id=$_POST['user_id'];
$friendid=$_POST['urid'];
$score=$_POST['score'];
$sql="UPDATE result SET score=$score WHERE Uid='$user_id' and id=$friendid";
$result=mysqli_query($connection, $sql);
echo $result;
 ?>

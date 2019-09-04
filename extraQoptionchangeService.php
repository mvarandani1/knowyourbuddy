<?php include '../includes/db.php'?>
<?php
$q_id=$_POST['q_id'];
$sql="Select * from extraqoption where q_id=$q_id";
$execute=mysqli_query($connection,$sql);
while($row=mysqli_fetch_assoc($execute))
{
  $extraqoptionarray[]=$row['optionname'];
}
echo json_encode($extraqoptionarray);

exit;
?>

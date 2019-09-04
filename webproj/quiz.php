<?php include 'includes/header.php' ?>
<div class="container masthead mt-5">
  <div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8 border border-dark box text-center" style="">
      <div class="h4 mt-3">
        How Well Do You know Mahesh
      </div>
      <div class="guestInfo mt-3 p-3">
        <form action="" method="post">
  <div class="form-group ">
    <label for="name" id="guestName">Name:</label>
    <input type="text" class="form-control" placeholder="For ex: jack" id="name" name="name">
  </div>
  <div class="btnCover mx-3"><input type="submit" id='submitbtn' name='submit' class="btn btn-block btn-secondary" value='submit'/></div>
</form>
      </div>
    </div>
    <div class="col-md-2">

    </div>
</div>
<?php
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
    if(isset($_GET['user_id']))
    {
      $user_id=$_GET['user_id'];
      $curr_date = date("Y-m-d H:i:s");
      $sql="Insert into result (Uid,friendname,datetime,score) values('$user_id','$name','$curr_date',0)";
      $result=mysqli_query($connection,$sql);
      if($result)
      {
        $friendid=$connection->insert_id;
        $_SESSION['user_id']=$user_id;
        $_SESSION['friendid']=$friendid;
        header('location:quizanswers.php?user_id='.$user_id.'&urid='.$friendid);
      }
      else
      {
        echo"<script>alert('Something went wrong')</script>";
      }
  }

}
 ?>

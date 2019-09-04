<?php include 'includes/header.php' ?>
<?php
 if(isset($_SESSION['Uid']))
{
  if(isset($_SESSION['hasQuiz']) && $_SESSION['hasQuiz']==1)
  {
    header('Location:results.php');
  }
} ?>
  <header class="masthead bg-primary  text-center" >
    <div class=" text-center  container secondcolumn" style="display: none" >
<div class="row">
      <div class="col-md-2 col-sm-2 col-xs-2">
        &nbsp;
      </div>

      <div class="col-md-8 bg-white col-sm-8 col-xs-8">

        <form action="" class="mt-5" method="post">
    <div class="form-group">
      <label for="name" class="name font30px">Name:</label><br>
      <input type="text" name="name" class="w-50 box-width" id="name">
    </div>
    <div class="form-group">
      <label for="gender" class="gender font30px">Gender:</label><br>
      <label class="radio-inline">
      <input type="radio"  name="optradio" value="M" checked><img src="https://img.icons8.com/bubbles/50/000000/bartender-male.png"> <span class="font-weight-bold bluecolor">Male</span>
    </label>
    &nbsp;
    <label class="radio-inline">
      <input type="radio" value="F" name="optradio"><img src="https://img.icons8.com/bubbles/50/000000/bartender-female.png"><span class=" font-weight-bold redcolor"> Female</span>
    </label>

    </div>

    <button type="submit" name="go" class="btn btn-danger mb-3" id="go" disabled>Go</button>
  </form>
  <?php
if(isset($_POST['go']))
{
  try
  {
      $name=$_POST['name'];
      $gender=$_POST['optradio'];
      $user_id=substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 7)), 0, 7);
          mysqli_query($connection,"START TRANSACTION");
      $sql="Insert into users(u_id, name,gender) values('$user_id','$name','$gender')";
      $executeQuery=mysqli_query($connection,$sql);
    if($executeQuery)
    {
      $_SESSION["Uid"]=$user_id;
      $_SESSION["uname"]=$name;
      mysqli_query("COMMIT");
      //Setting Cookie
     $cookie_name = "$#$$!";
     $cookie_value = session_id();
     setcookie($cookie_name, $cookie_value, time() + 2592000, "/"); // 86400 = 1 day
     //end
      header("Location:questions.php");
      die();
    }
    else {
        mysqli_query($connection,"ROLLBACK");
    }
  }
 catch (Exception $e) {
        echo"Error";
}
}
   ?>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">
        &nbsp;
      </div>
    </div>
    </div>
    <div class="container d-flex align-items-center flex-column text-white">
<div class="startcolumn">
      <h2>Check How Much Your Friends Know You ?</h2>

    <div class="mt-3">
      <ol class="startext" >
        <li >Answer questions about yourself.</li>
        <li>Your quiz link will be created.</li>
        <li>Send link to your friends.</li>
        <li>Come back to see their results.</li>
    </ol>
    </div>
    <div class="mt-4">
      <button type="button" name="button" class="btn btn-danger startbutton" id="getstartbutton" >Get Started</button>
    </div>
  </div>


    </div>

  </header>



  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <div class="row">



      </footer>

      <?php include 'includes/footer.php' ?>
      <script type="text/javascript">
        $('#name').keyup(function()
      {
        if($(this).val().length>0)
        {
          $('#go').prop('disabled',false);
        }
        else {

          $('#go').prop('disabled',true);
        }
      });
      </script>

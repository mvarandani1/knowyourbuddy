<?php include 'includes/header.php' ?>
<?php

// if(!isset($_SESSION['Uid']))
// {
//   header("Location:index.php");
//   die();
// }
// if(!isset($_SESSION['hasQuiz']))
// {
//   if($_SESSION['hasQuiz']!=1)
//   {    header("Location:questions.php");
//     die();
//   }
//
// }


// Delete quiz by calling SP and Deleteing Session and Cookie
if(isset($_POST['delete']))
{
  try {
    $user_id=$_SESSION["Uid"];
    session_destroy();
    mysqli_query($connection,"CALL delete_UserData('$user_id')");
  $cookie_name = '$#$$!';
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie($cookie_name, '', time() - 3600);
echo "<script>location.reload();</script>";
} catch (\Exception $e) {
echo e;
}
}
 ?>
<style media="screen">

  html, body {
margin:0;
padding:0;
width:100%;
height:100%;
overflow: auto;
background-color: #f6f6f6 !important;
}
.box
{

  box-shadow: 0 0 1px 1px lightgrey;
  border: 1px solid lightgrey;
  border-radius: 0;
  background-color:white;
  padding:2rem;
}
.quizHeading
{
  background-color:#55552b;
  padding: 1rem;
  color: white;
}
ul{
  text-align: left;
  list-style-type: none;
}
.link {
    width: 350px;
    max-width: 100%;
    height: 24px;
}
</style>

<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are You Sure You Want To Delete?</h5>

      </div>
      <div class="modal-body text-center">
        <span class="h5">Quiz once Deleted cannot be reverted</span>
      </div>
      <div class="modal-footer">
        <button type="button" id="yesbtn" class="btn btn-secondary m-auto" data-dismiss="modal">Yes</button>
        <button type="button" id="nobtn" class="btn btn-secondary m-auto" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<div class="text-center masthead">
<div class="container">
  <div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8 border border-dark box" style="">
      <div class="quizHeading"><h1><?php echo $_SESSION["uname"] ?>'s Quiz</h1></div>

    <div class="quizInstruction mt-4 text-center">
      <span><h4>Your Quiz has been Processed !</h4></span>

      <ul class="ml-5 mt-3">
          <li>1) Copy The Link by clicking on Copy Link Button </li>
          <li>2) Send Link To your Friends  </li>
          <li>3) Share the link on social Media </li>
          <li>4) Check Back here to see which of your friend did best </li>
      </ul>

    </div>
    <div class="linkdiv">
      <span>Your Link:</span>
      <?php
      $link= $_SERVER['HTTP_HOST']."/webproj/quiz.php?user_id=".$_SESSION['Uid'];
      ?>
      <span><input class="link" type="text" value="<?php echo $link ?>" id="quizLink" readonly=""></span>
    </div>
    <button type="button" class="btn btn-secondary mt-3" onclick="copyToClipboard('#quizLink')" id='linkbtn' >Copy Link</button>

    <button type="button" id="deleteQuiz" class="btn btn-secondary btn-lg btn-block mt-3" data-toggle="modal" data-target="#myModal">Delete Quiz and Add new One!</button>
        </div>
    <div class="col-md-2">

    </div>
  </div>
</div>

</div>

<?php include 'includes/footer.php' ?>
<script type="text/javascript">
function copyToClipboard(element) {
  var copyText = document.getElementById("quizLink");
    /* Select the text field */
    copyText.select();
    /* Copy the text inside the text field */
    document.execCommand("copy");
}
$('#yesbtn').click(function()
{

$.post( "results.php", { delete:"yes"} ).done(function(response){
      location.reload();
});

});
</script>

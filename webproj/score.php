<?php include 'includes/header.php' ?>
<?php
if(!isset($_GET['urid']))
{
  header('Location: quiz.php');
}
else {


}
 ?>
 <style>
  .box {
    float: left;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
  }

  .wrapper {
    position: relative;
    width: 320px;
    height: 240px;
    margin: 50px auto 0 auto;
    padding-bottom: 30px;
    clear: both;
  }

  .gauge {
    width: 320;
    height: 240px;
  }

  button {
    margin: 30px 5px 0 2px;
    padding: 16px 40px;
    border-radius: 5px;
    font-size: 18px;
    border: none;
    background: #34aadc;
    color: white;
    cursor: pointer;
  }

    a:hover {
        text-decoration: none;
        color:white;
        }
    a{
     color:white;
      }
  #log {
    color: #ccc;
  }
  #attemptheader
  {
    color: #2c3e50 !important;
    font-family: 'Rouge Script', cursive; font-size: 50px; font-weight: normal; line-height: 48px; margin: 0 0 50px; text-align: center; text-shadow: 1px 1px 2px #082b34;
  }
</style>
<?php
$urid=$_GET['urid'];
$getinfosql="Select u.name,r.score from result r join users u on r.Uid=u.u_id where id=$urid";
echo "<script>console.log('$getinfosql');</script>";
$get=mysqli_fetch_assoc(mysqli_query($connection, $getinfosql));
$username=$get['name'];
$score=$get['score'];
 ?>
<script type="text/javascript" src="js/raphael.min.js">  </script>
<script type="text/javascript" src="js/justgage.js" >  </script>
<header class="masthead  text-center" >
  <?php
  if(isset($_GET['urid']))
{
  $check="select * from result where id=$urid";
  if(mysqli_num_rows(mysqli_query($connection, $check))<1)
  {echo "<h2>You have'nt responded to this quiz</h2>";
    exit;
  }
}
   ?>
<div class="scoresection">
<h2 id='attemptheader'>Yeah!! You attempted <?php echo $username?>'s Quiz</h2>
<h4>Your Score is</h4>
</div>
<div class="gauge_container">
  <div class="wrapper">
    <div class="box">
      <div id="g1" class="gauge"></div>
    </div>
  </div>
</div>
<div class="commentsection">
</div>
<div class="createnewquiz container">
  <span style="font-size:22px">You can Create your own Quiz and send to your friends</span><br>
  <button type="button" class="btn btn-secondary btn-lg btn-block mt-3" ><a href="index.php">Create Your Quiz</a></button>
</div>

<div class="mt-3"><span style="font-size:18px">You can Check Your response/answer For the mahesh's quiz</span><br>
<button type="button" class="btn btn-primary btn-lg  m-2" id="checkresponse">check your Response</button>
</div>
<div class="table container mt-2" style="display:none">
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Qno</th>
      <th scope="col">Question</th>
      <th scope="col">Your Response</th>
      <th scope="col">Answer</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $urid=$_SESSION['urid'];
    $user_id='ps30gbl';//$_SESSION['user_id'];
    //echo $user_id;
    $sql="select q.Qid,Question,(select up.options FROM usersans a join usersoption up on up.id=a.optid  where a.Uid='$user_id' and a.Qid=q.Qid)ans from usersq q where q.Uid='$user_id' ";
    $ans=mysqli_query($connection,$sql);

    while($row=mysqli_fetch_assoc($ans))
    {
      $qno=(int)$row[Qid]+1;
      echo"<tr>";
      echo"<td>$qno</td>";
      echo"<td>$row[Question]</td>";
      echo"<td>$row[ans]</td>";
      echo"</tr>";
    }
     ?>
  </tbody>
</table>
</div>
</header>
<?php include 'includes/footer.php'?>
<script type="text/javascript">
function getComment()
{$name="<?php echo $username?>";
  $score=<?php echo $score?>;
  if($score<4)
  {
    return "<h3 id='comment'>It seems like you less know "+ $name+"<span style='font-size:40px;'>&#128542;</span></h3>";
  }
  else if($score>4 &&$score<=7)
  {
    return "<h3 id='comment'>Ohh you know "+ $name+" well <span style='font-size:40px;'>&#128522;</span></h3>";
  }
  else if($score>7)
  {
    return "<h3 id='comment'>You and "+$name+" are best friends <span style='font-size:40px;'>&#128558;</span></h3>";
  }
}
$( document ).ready(function() {
  $('#checkresponse').click(function()
{
  $('.table').show();
});
});
    document.addEventListener("DOMContentLoaded", function (event) {

      var g1 = new JustGage({
        id: 'g1',
        value: <?php echo $score?>,
        min: 0,
        max: 10,

        pointer: true,
        pointerOptions: {
          toplength: -15,
          bottomlength: 10,
          bottomwidth: 12,
          color: '#8e8e93',
          stroke: '#ffffff',
          stroke_width: 3,
          stroke_linecap: 'round'
        },
        gaugeWidthScale: 0.6,
        counter: true,
        onAnimationEnd: function () {
          debugger;
          $(".commentsection").html(getComment());

        }
      });


    });

  </script>

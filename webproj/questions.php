<?php include'includes/header.php'?>
<?php
if(isset($_SESSION['Uid']))
{
  if(isset($_SESSION['hasQuiz']) && $_SESSION['hasQuiz']==1)
  {
    header('Location:results.php');
  }
}
else {
  header('Location:index.php');
}
 ?>
<style>

</style>
<?php



if(isset($_POST['data']))
{
  try
    {
      $data=$_POST['data'];
      $decodeData=json_decode($_POST['data'],true);
      $User_id=$_SESSION["Uid"];
      mysqli_query($connection,"START TRANSACTION");
      for($i=0;$i<10;$i++)
      {
        $questions[$i]=$decodeData[$i][question];
        $questionwithslash=$questions[$i];

        $color=$decodeData[$i][color];
        $Qquery="insert into usersq(Uid,Qid,Question,color) values('$User_id',$i,'$questionwithslash','$color')";
        mysqli_query($connection, $Qquery);
        $ans=$decodeData[$i][answers];

        mysqli_query($connection, $ansquery);
          for($j=0;$j<count($decodeData[$i][options]);$j++)
          {
            $option=$decodeData[$i][options][$j][optionname];
            $optionQuery="insert into usersoption(Uid,Qid,optid,options) values('$User_id',$i,$j,'$option')";
            mysqli_query($connection,$optionQuery);
          }
          $ansquery="Insert into usersans(Uid,Qid,optid)select '$User_id', $i, id from usersoption where options='$ans' and Uid='$User_id'";
      }
      $updateuserquery="update users set hasQuiz=1 where u_id='$User_id'";
      mysqli_query($connection,$updateuserquery);
      $_SESSION['hasQuiz']=1;
        mysqli_query($connection,"COMMIT");
echo"adfsagdhfgnh";
echo $Qquery;
        //header("Refresh:0");
    }
  catch (Exception $e)
   {
      mysqli_query("ROLLBACK");
     echo"error";
   }
}
 ?>




<?php
$i=1;
$sql="select * from questions where type=1 limit 10";
$get=mysqli_query($connection,$sql);


?>
<header class="masthead  text-center" >
  <form id='form' action="" method="post" enctype="multipart/form-data">
<div class="container" id='mainwindow'>
  <?php

  while($row=mysqli_fetch_assoc($get))
  {
    $q_id=$row['q_id'];
    $question=$row['question'];
    $color=$row['color'];
  $colorsql="select * from color where id=$color";
  $run=mysqli_query($connection,$colorsql);
  $colorrow=mysqli_fetch_assoc($run);
  $colorcode=$colorrow['name'];
  ?>
  <div class="row mt-2" id="questionContainer<?php echo $i ?>">
    <div class="col-md-2 col-sm-2 col-xs">
      &nbsp;
    </div>
    <div class="col-md-8 col-sm-8 col-xs  h-75 p-5 question_block_square<?php echo $i ?>" color="<?php echo $colorcode ?>" style="background:<?php echo $colorcode ?>">
      <h2>Question <?php echo $i ?> of 10</h2>
      <div class="mt-3 mb-2 qcover">
        <textarea row="2" class="w-100 font-22 qheight p-8 textq" name="question<?php echo $i ?>" id="question<?php echo $i ?>" class='Qtext' placeholder="Write Your Question here" autofocus disabled><?php echo $question ?></textarea>
      </div>

<select class="Qselect" >
    <option value="">More Suggested Question</option>
  <?php
  $sql="Select * from extraquestions where type=1";
  $run=mysqli_query($connection,$sql);
  while($extraqrow=mysqli_fetch_assoc($run))
  {$question=$extraqrow['question'];
    $extraq_id=$extraqrow['q_id'];

  echo"<option value='$extraq_id'>$question</option>";
}
   ?>


</select>

<div  class="answermaindiv mt-2" >

<?php

 $sql="Select * from options where q_id=$q_id" ;
$runq=mysqli_query($connection,$sql);
$j=1;
while($optionrow=mysqli_fetch_assoc($runq))
{
$option=$optionrow['answer'];

?>

  <div class="row mt-2" >
          <div class="answerdiv  ">
        <input type="radio" class="option-input mb-3 radio radioanswer_<?php echo $i ?>" name="radioanswer_<?php echo $i ?>" >
        &nbsp;
        <textarea row="1" name="answer_<?php echo $i ?>_<?php echo $j ?>" class="font-22 answerwidth  p-2 textq " placeholder="Write Your answer here" autofocus><?php echo $option; ?></textarea>
        </div>
    <div class=" crossbutton"><button type="button" class="btn delbutton" style="color:white" name="button">X</button></div>
  </div>
<?php $j++ ;} ?>
</div>
<div class="addoptionbutton mt-3" option="<?php echo $j; ?>" question="<?php echo $i; ?>">
<button type="button" class="btn btn-danger w-50" id='addoption<?php echo $i ?>'  onclick="addoption(this)" name="button">Add an Option</button>
</div>
<div class="color_select_div mt-3">
  <button class="circle_button" type="button" value='#1D2951' style="background-color: #1D2951" id="color_button_3_0" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #4F97A3" id="color_button_3_1" value="#4F97A3" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #FA8072" id="color_button_3_1" value="#FA8072" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #D21F3C" id="color_button_3_1" value="#D21F3C" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #EFFD5F" id="color_button_3_1" value="#EFFD5F" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #FDA50F" id="color_button_3_1" value="#FDA50F" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #0B6623" id="color_button_3_1" value="#0B6623" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
  <button class="circle_button" type="button" style="background-color: #50C878" id="color_button_3_1" value="#50C878" qno='<?php echo $i?>' onclick="change_bg_color(this,this.value)"></button>
    </div>

    <div class="col-md-2 col-sm col-xs ">
      &nbsp;
    </div>
  </div>
</div>
<?php $i++;} ?>
</div>
<div class="mt-3">
  <input type="button" class="btn btn-primary w-50" id='submit' name="submit" value="Submit"/>
</div>
</form>
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>

      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">OK</button>

      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<header>




<?php include 'includes/footer.php'?>
<script>
$(document).ready(function()
{


$(".Qselect").dropkick({
  mobile: true,
});
$(".Qselect").change(function()
{
  $(this).parent().children("div").children("textarea").val($(this).children("option:selected").text());

});
$('#submit').click(function(e) {
  e.preventDefault();

  $go=true;
  for($i=1;$i<=10;$i++)
  {
    $radiobuttonclass =".radioanswer_"+$i;


      if($(".radioanswer_"+$i).is(":checked")==false)
      {
        $body="<span class='h6'>Please Select The Question No <span class='text-danger'>"+$i+"</span> to continue</span>";
        $('#myModal').modal('show');
        $('.modal-body').html($body);
        $go=false;
          $("#questionContainer"+$i).scrollView();

        break;
      }
  }

  if($go)
  {
  $jsonarray=[];
  for($i=1;$i<=10;$i++)
  {
    $radiobuttons="[name='radioanswer_"+$i+"']";
    $arrayname="optionarray_"+$i;
    $arrayname=[];
    $ans=$($radiobuttons+':checked').next().val()

    $($radiobuttons).each(function()
    {
        $optionObject={
          optionname:$(this).next().val()
        }
        $arrayname.push($optionObject);


    });

    $question=$('#question'+$i).val();
$color=$('.question_block_square'+$i).attr("color");

  $jsonobject={
    question:$question,
    answers:$ans,
    options:$arrayname,
    color:$color
  }
$jsonarray.push($jsonobject);

}
var jsonString = JSON.stringify($jsonarray);
debugger;
$.ajax({

        type: "POST",
        url: "questions.php",
        ContentType: "application/json",

        data: {"data":jsonString},
        cache: false,
        success: function(e){
             //window.location.replace("results.php");
             debugger;
             
        },
        error: function(jqXHR, textStatus, errorThrown) {
          debugger;
          console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('errorThrown:');
                        console.log(errorThrown);
                        }
    });

}
window.location="results.php";
});


$(document).on('click', '.delbutton', function() {
  $(this).parent().parent().remove();
});
});
function addoption(elem)
{
    $id = $(elem).attr("id");
    $optionnum=$("#"+$id).parent().attr('option');
    $qnum=$("#"+$id).parent().attr('question');
  $a='<div class="row mt-2"><div class="answerdiv  "><input type="radio" class="option-input mb-3 radio radioanswer_'+$qnum+'" id="radioanswer_'+$qnum+'"  value="2">&nbsp;&nbsp;';
  $a+='<textarea row="1" class="font-22 answerwidth  p-2 textq " name="answer_'+$qnum+'_'+$optionnum+'" placeholder="Write Your answer here" autofocus></textarea></div>';
  $a+='<div class="crossbutton"><button type="button" class="btn delbutton" style="color:white" name="button">X</button></div>';
$("#"+$id).parent().siblings(".answermaindiv").append($a);
$optionnum+=1;
$qnum+=1;
$("#"+$id).parent().attr('option',$optionnum);
$("#"+$id).parent().attr('question',$qnum);

//alert($("#"+$id).parent());

}

//Scroll logic on Question page
$.fn.scrollView = function () {
    return this.each(function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top-100
        }, 1000);
    });
}
//end of scroll logic
</script>

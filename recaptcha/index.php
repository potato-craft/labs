<!DOCTYPE HTML>
<html>
	<head>
	<title>ReCaptch'emAll | forgood studios</title>
	
	<link rel="stylesheet" type="text/css" href="page.css" />

	</head>
  <body>
    <form action="index.php" method="post" name="recaptchemall">
<?php

//DB connection ==========================================
$DB_servername="localhost";
$DB_username="vlpaplga_records";
$DB_password="helloThisIsYourMomCalling2U";
$con = mysql_connect($DB_servername,$DB_username,$DB_password);
//DB connection end ======================================

//game var init ==============================================

if(isset($_POST["gamer"]) && isset($_POST["score"])){
	$prompt=FALSE;
	$score=$_POST["score"];
	$gamer_ID=$_POST["gamer_ID"];
	if($_POST["gamer"]==""){
	$gamer="Anon";
	}
	else{
	$gamer=$_POST["gamer"];
	}
	require_once('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6Lda79oSAAAAADrbW6ux9g5bJj9PNl_PoD0RulKf";
$privatekey = "6Lda79oSAAAAAGdUZ1LkvhHNsWuiCVIq-0K7m6Xr";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
		
        if ($resp->is_valid) {
			$score+=1;
			$correct=TRUE;
        } else {
			$correct=FALSE;
                # set the error code so that we can display it
                $error = $resp->error;
        }
}
echo "<div id=\"input_container\">";
echo recaptcha_get_html($publickey, $error); //recaptcha html output
echo"</div>";
echo "<div id=\"submit_container\"><input type=\"submit\" value=\"submit\" /></div>";
        if ($correct) {
                echo "You got it!";
        } 
		echo "<br/>";
}
else{
	$prompt=TRUE;
	$score=0;
}


if($prompt){
	$arr = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // get all the characters into an array
	shuffle($arr); // randomize the array
	$arr = array_slice($arr, 0, 6);
	$conf_code= implode('', $arr);
	$date= date('ymdHis');
	$gamer_ID=$date.$conf_code;
?>
<div id="input_container">
<input type="text" name="gamer" value="" placeholder="Enter a gaming name" />
</div>
<input type="hidden" name="score" value="0" />
<input type="hidden" name="gamer_ID" value="<?php echo $gamer_ID ?>" />
<input type="submit" value="submit" />
<?php 
}
else{
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
else{
	
	mysql_select_db("vlpaplga_leaderboard", $con);

	$entries_sql= "SELECT * FROM recaptcha WHERE name= '$gamer' AND gamerID='$gamer_ID' ";
	$entries_query= mysql_query($entries_sql, $con);
	$entries_result= mysql_num_rows($entries_query);

			if($entries_result==0){
				$sql=sprintf("INSERT INTO recaptcha (name, gamerID, score)
				VALUES ('%s','%s','%s')",mysql_real_escape_string($gamer), mysql_real_escape_string($gamer_ID), mysql_real_escape_string($score));
				
				if (!mysql_query($sql,$con))
				  {
				  die('Error: ' . mysql_error());
				  }
			}
			else{
				$update=sprintf("UPDATE recaptcha SET score='%s' WHERE name='%s' AND gamerID='%s'", mysql_real_escape_string($score), mysql_real_escape_string($gamer), mysql_real_escape_string($gamer_ID));
			if (!mysql_query($update,$con))
				  {
				  die('Update Error: ' . mysql_error());
				  }
			
			} 
}


// some code
?>

<input type="hidden" style="display:none;" name="gamer" value="<?php echo $gamer; ?>" />
<input type="hidden" style="display:none;" name="gamer_ID" value="<?php echo $gamer_ID; ?>" />
<input type="hidden" style="display:none;" name="score" value="<?php echo $score; ?>" />

<?php echo "<span class=\"gamer_name\">". $gamer."</span>"; ?>
<?php echo "<span class=\"gamer_score\">". $score."</span><br/>"; ?>

<script>
document.recaptchemall.recaptcha_response_field.focus();
</script>

<?php
}
?>    

   
    </form>
    <ol class="leaderboard">
<?php
mysql_select_db("vlpaplga_leaderboard", $con);
$result = mysql_query("SELECT * FROM recaptcha ORDER BY score DESC");

while($row = mysql_fetch_array($result))
  {
	  if($row['gamerID']==$gamer_ID){
		  echo "<li><span class=\"name current_player\">".$row['name']." </span>";
		  echo "<span class=\"score current_player\">".$row['score']." </span></li>";
	  }
	  else{
		  echo "<li><span class=\"name\">".$row['name']." </span>";
		  echo "<span class=\"score\">".$row['score']." </span></li>";
	  }
  
  }
?>
</ol>
  </body>
</html>

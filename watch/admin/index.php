<?php  
  if(preg_match('(^[a-zA-Z0-9]{11}$)', $_GET["v"])){
    $vid=$_GET["v"];
    $valid=true;
  }
  else{
    $vid="";
    $valid=false;
  }
  if($valid){
    $con=mysqli_connect("localhost","vlpaplga_vidw","ICanHasVideo?","vlpaplga_video");

    // Check connection
    if (mysqli_connect_errno($con)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql="SELECT * FROM video WHERE vid='".$vid."'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    $url=$result['url'];
    $sql="SELECT * FROM state WHERE vid='".$vid."'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    $seek=$result['seek'];
    $start=$result['start'];
  }
  
  if(!$valid){
    echo "Invalid url";
  }
  
  if($valid):
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin | Watch</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
body{
  background-color:black;
}
video{
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<video id="player" controls>
  <source src="<?php echo $url; ?>"></source>
</video>
<script>
var vid="<?php print $vid;?>";
var url="<?php print $url;?>";
var seek=<?php print $seek;?>;
var player;
var start=<?php print $start;?>;
player=document.getElementById('player');
player.addEventListener("loadedmetadata", function() {
  console.log("loaded");
  this.currentTime = seek;
  this.play();
  console.log(start);
  start=Math.round(new Date().getTime() / 1000);
  console.log(start);
}, false);

var rjvid=player;
var rjvo={
  stat:0,  //status 0:paused, 1:playing
  time:0,   //time (to one decimal
  id:vid
}
$("video").on("pause", function (e) {
  status(e, 0);
});
$("video").on("play", function (e) {
  status(e, 1);
});

function status(e, s){
  var t=trunc(e.target.currentTime);
  rjvo.stat=s;
  rjvo.time=t;
  
  send(s,t);
}

function trunc(num){
  return Math.round( num * 10 ) / 10;
}

function send(s, t){
  
  var xmlhttp;    
  xmlhttp=new XMLHttpRequest();
  console.log("send.php?v="+rjvo.id+"&s="+s+"&t="+t);
  xmlhttp.open("GET","send.php?v="+rjvo.id+"&s="+s+"&t="+t,true);
  xmlhttp.send();
}
</script>
</body>
</html>
<?php endif; ?>

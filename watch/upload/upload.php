<?php
$con=mysqli_connect("localhost","vlpaplga_vidw","ICanHasVideo?","vlpaplga_video");

// Check connection
if (mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function genVid(){
    $length = 11;
    $characters = '0123456789012345678901234567890123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

do{
  $vid = genVid();
  $sql="SELECT vid FROM video WHERE vid='".$vid."'";
  $query = mysqli_query($con, $sql);
  $exists = mysqli_fetch_array($query);
}
while(sizeof($exists) != 0);

$url=$_GET["q"];

if(trim($url)!=""){
$sql="INSERT INTO video (vid , url ) VALUES ('".$vid."','".mysqli_real_escape_string($con, $url)."')";
mysqli_query($con, $sql);
$sql="INSERT INTO state (vid , status, start) VALUES ('".$vid."','0','".time()."')";
mysqli_query($con, $sql);
echo $vid;
}
else{
  echo "error";
}

?>

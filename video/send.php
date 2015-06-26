<?php
// Create connection
$con=mysqli_connect("localhost","vlpaplga_vidw","ICanHasVideo?","vlpaplga_video");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  echo("s: ".$_GET[s]." | t: ".$_GET[t]);
  
  $sql="UPDATE state SET status='".$_GET[s]."', seek='".$_GET[t]."' WHERE vid='".$_GET[v]."'";
  if (mysqli_query($con,$sql))
  {
  echo "yay!";
  }
  else
  {
  echo "NAY!: " . mysqli_error($con);
  }
  mysqli_close($con);
?>

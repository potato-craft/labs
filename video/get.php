<?php
// Create connection
  
  $con=mysqli_connect("localhost","vlpaplga_vidr","CanIHaveVideo?","vlpaplga_video");
  // Check connection
  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
  $sql="SELECT * FROM state WHERE vid='".$_GET[id]."'";
  
  $result = mysqli_query($con, $sql);

  while($row = mysqli_fetch_array($result))
    {
    $rjvo = array(
        'stat' => $row['stat'],
        'time' => $row['time'],
     );
    echo json_encode($rjvo);
    }

  mysqli_close($con);
?>

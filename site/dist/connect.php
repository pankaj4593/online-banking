<?php
  $con = mysqli_connect("localhost","root","","bank_db1");

  if ($con)
  {
    // echo "Done";
  }
  else
  {
    echo "Conncetion Not Connect";
  }
?>
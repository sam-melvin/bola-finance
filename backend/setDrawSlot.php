<?php
date_default_timezone_set('Asia/Manila');
include 'dbConfig.php';
 $currentTime = time();
 
 $getTiMe = ((int) date('H', $currentTime));
 echo $getTiMe;
 echo "<br />";



 $sql = "SELECT `id`, `setHour` FROM `create_draw_dt` WHERE `active` = '1' ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $did = $row["id"];
      $shour =  $row["setHour"];

    // echo "id: " . $row["id"]. " - Set hour: " . $row["setHour"]. " <br />";

  }
} else {
//   echo "0 results";
}

if($did <= 7) {
    if($getTiMe >= $shour){

        // echo  "draw time <br /> ";
        $addid = $did + 1;
        // echo "add id: ".$addid;
        $sql2 = "UPDATE `create_draw_dt` SET `active`='1' WHERE `id`= '$addid' ";

        if ($conn->query($sql2) === TRUE) {
            echo "Record updated successfully";
        } else {
            // echo "Error updating record: " . $conn->error;
        }

        $sql3 = "UPDATE `create_draw_dt` SET `active`='0' WHERE `id`= '$did' ";

        if ($conn->query($sql3) === TRUE) {
            // echo "Record updated2 successfully";
        } else {
            // echo "Error updating record: " . $conn->error;
        }
    }
} 
else {
    if($getTiMe == 0 && $did == 8){
        
        // echo  "draw time <br /> ";
        // $addid = $did + 1;
        // echo "add id: ".$addid;
        $sql2 = "UPDATE `create_draw_dt` SET `active`='1' WHERE `id`= '1' ";

        if ($conn->query($sql2) === TRUE) {
            echo "Record updated successfully";
        } else {
            // echo "Error updating record: " . $conn->error;
        }

        $sql3 = "UPDATE `create_draw_dt` SET `active`='0' WHERE `id`= '$did' ";

        if ($conn->query($sql3) === TRUE) {
            // echo "Record updated2 successfully";
        } else {
            // echo "Error updating record: " . $conn->error;
        }
    }
}
 
    

        

$conn->close();

?>

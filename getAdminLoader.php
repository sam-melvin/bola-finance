<option value="">Choose a Loader to send money</option>
<?php
session_start();
include 'dbConfig.php';
$prov = $_GET['province'];
$sql = "SELECT `id`,`code`,`full_name` FROM `admin_user` WHERE `assign_location`='$prov' AND `type`='3' ORDER BY `code` ASC ";

if($result=mysqli_query($conn, $sql)) {
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            $ids = $row['id'];
            $code = $row['code'];
            $full_name = $row['full_name'];
                 echo "<option value='$ids' data-code='$code'>$code : $full_name</option>";
        } 
        mysqli_free_result($result);
    }else{
        echo "error";
    }
} 

    
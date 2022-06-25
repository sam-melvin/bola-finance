<?php

    class Utilities {


        public function getProvince($p_id)
        {
            $province = '';
            $sql = "SELECT * FROM `province` WHERE `id`='$p_id'";
            f ($result = mysqli_query( $conn, $sql)) {

                if (mysqli_num_rows($result) > 0) {
            
                    while ($row = mysqli_fetch_assoc($result)) {
            
                        $province = $row['province'];
                    }
            
                    mysqli_free_result($result);
            
                } else {
                    echo "error";
                }
            }

            return $province;

        }


    }


?>
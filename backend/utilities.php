<?php
include 'dbConfig.php';

    class Utilities {
        public $database;

        public function __construct()
        {
            global $conn;
    
            $this->database = $conn;
        }
    

        public function getProvince($p_id)
        {
            $province = '';
            $sql = "SELECT * FROM `province` WHERE `id`='$p_id' ";
            if ($result = mysqli_query($this->database, $sql)) {

                if (mysqli_num_rows($result) > 0) {
            
                    while ($row = mysqli_fetch_assoc($result)) {
            
                        $province = $row['province'];
                    }
            
                    mysqli_free_result($result);
            
                } else {
                    echo "";
                }
            }

            return $province;

        }


        public function getLive()
        {
            $live = array();
            $sql = "SELECT * FROM `live` WHERE 1=1 ";
            if ($result = mysqli_query($this->database, $sql)) {

                if (mysqli_num_rows($result) > 0) {
            
                    while ($row = mysqli_fetch_assoc($result)) {
            
                        $live['live'] = $row['live'];
                        $live['url_src'] = $row['url_src'];
                    }
            
                    mysqli_free_result($result);
            
                } else {
                    echo "";
                }
            }

            return $live;

        }


    }


?>
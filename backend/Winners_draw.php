<?php
include 'dbConfig.php';

class Winners {

    public $database;

    public function __construct()
    {
        global $conn;

        $this->database = $conn;
    }

    

    public function getLucky($winningNumbers, $wid)
    {
        $historyLogs = $this->queryWinners($wid);
        $winners = [];

        foreach ($historyLogs as $logs) {

            // $betNumbers = json_decode($logs['digit']);

            if($logs['category'] == "3ds") {
                $betNumbers = $logs['digit'];
                $cate = $logs['category'];
                
                
                $hasStraight = $this->straight($winningNumbers, $betNumbers);
                if (!empty($hasStraight) ) {
                    
                    // $amount_prize = $logs['amount'] * 500;
                    $amount_prize = number_format((float)$logs['amount'] * 500, 2, '.', '');
                    $winners['winners'][] = [
                            'bet_id' => $logs['id'],
                            'user_id' => $logs['user_id'],
                            'draw_id' => $logs['draw_id'],
                            'category' => $logs['category'],
                            'location' => $logs['location'],
                            'digit' => $logs['digit'],
                            'amount' => $logs['amount'],
                            'prize_amount' => $amount_prize

                    ];

                    
                }


            }

            if($logs['category'] == "3dr") {
                $betNumbers = $logs['digit'];
                $cate = $logs['category'];
                
                
                if (!empty($betNumbers)) {
                    $hasRumble = $this->rumble($winningNumbers, $betNumbers);
                    if (!empty($hasRumble) ) {
                       

                        $amount_prize = number_format((float)$logs['amount'] * 80, 2, '.', '');
                        $winners['winners'][] = [
                            'bet_id' => $logs['id'],
                            'user_id' => $logs['user_id'],
                            'draw_id' => $logs['draw_id'],
                            'category' => $logs['category'],
                            'location' => $logs['location'],
                            'digit' => $logs['digit'],
                            'amount' => $logs['amount'],
                            'prize_amount' => $amount_prize
                    ];

                       
                    }
                }
                
                
            }

            if($logs['category'] == "2d") {
                $betNumbers = $logs['digit'];
                $cate = $logs['category'];
                

                if (!empty($betNumbers)) {
                    $hasTwoDigits = $this->getLastTwo($winningNumbers, $betNumbers);
                    
                    if (!empty($hasTwoDigits)) {

                        $amount_prize = number_format((float)$logs['amount'] * 50, 2, '.', '');
                        $winners['winners'][] = [
                            'bet_id' => $logs['id'],
                            'user_id' => $logs['user_id'],
                            'draw_id' => $logs['draw_id'],
                            'category' => $logs['category'],
                            'location' => $logs['location'],
                            'digit' => $logs['digit'],
                            'amount' => $logs['amount'],
                            'prize_amount' => $amount_prize
                    ];
                        
                    }
                }
               

                
                
            }

            if($logs['category'] == "1d") {
                $betNumbers = $logs['digit'];
                $cate = $logs['category'];
                

                if (!empty($betNumbers)) {
                    $hasOneDigit = $this->getLastOne($winningNumbers, $betNumbers );

                    if (!empty($hasOneDigit)) {
    
                        
                        $amount_prize = number_format((float)$logs['amount'] * 5, 2, '.', '');
                        $winners['winners'][] = [
                            'bet_id' => $logs['id'],
                            'user_id' => $logs['user_id'],
                            'draw_id' => $logs['draw_id'],
                            'category' => $logs['category'],
                            'location' => $logs['location'],
                            'digit' => $logs['digit'],
                            'amount' => $logs['amount'],
                            'prize_amount' => $amount_prize
                    ];
                        
                    }
                }
                
                
            }
            
            
        }

        return $winners;
    }

    
    
    private function straight($winningNumbers, $betNumbers)
    {
        if (empty($betNumbers)) {
            return false;
        }

        $winningEntryKeys = 0;
        // if($betNumbers == 0 && $winningNumbers == 0) {
        //     $betNumbers = '00'.(string)$betNumbers;
        //     $winningNumbers = '00'.(string)$winningNumbers;
        // }

        if ($betNumbers == $winningNumbers) {
            $winningEntryKeys = 1;
        }
        

        

        return $winningEntryKeys;
    }

    private function rumble($winningNumbers, $betNumbers)
    {
        if (empty($betNumbers)) {
            return false;
        }

        $winningEntryKey = 0;
        $singlized       = [];
        
        $singlizedW[0] = substr($winningNumbers, 0, 1);
        $singlizedW[1] = substr($winningNumbers, 1, 1);
        $singlizedW[2] = substr($winningNumbers, 2, 2);
        
       
            

            $singlizedB[0] = $betNumbers[0];
            $singlizedB[1] = $betNumbers[1];
            $singlizedB[2] = $betNumbers[2];

            for($i=0;$i<=2;++$i) {
                if (in_array( $singlizedW[$i], $singlizedB )) {
                    $ark = array_search($singlizedW[$i], $singlizedB);
                    unset($singlizedB[$ark]);
                }
            }

            if (count($singlizedB) === 0 && $winningNumbers != $betNumbers) {
                $winningEntryKey = 1;
            }
       

        return $winningEntryKey;
    }

    private function getLastTwo($winningNumbers, $betNumbers)
    {
        $substr = substr($winningNumbers,1,2);
        $winningEntryKey = 0;
        
        if($substr == $betNumbers) {
                    $winningEntryKey = 1;
        }
        

        return $winningEntryKey;
    }

    private function getLastOne($winningNumbers, $betNumber)
    {
        $substr = substr($winningNumbers,-1);
        $winningEntryKey = 0;
        
        if($substr == $betNumber) {
            $winningEntryKey = 1;
        }

       

        return $winningEntryKey;
    }
    
   


    private function queryWinners($wid)
    {
        $sql = "SELECT `id`, `user_id`, `draw_id`, `category`, `digit`, `amount`, `location` FROM `bets` WHERE `draw_id` = '$wid' AND `status`='pending' ";

        

        $historyLogs = [];

        if ($result = mysqli_query($this->database, $sql)) {

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $historyLogs[] = $row;
                }

                mysqli_free_result($result);

            } else {
                // echo "error";
            }
        }

        return $historyLogs;
    }
}

$winners = new Winners();
$win_nums = $_POST['win_nums'];
$draw_no = $_POST['draw_no'];

$drawNumber = $win_nums;
$wid = $draw_no;
// $drawNum = 1;
$results = $winners->getLucky($drawNumber, $wid);


// function jsonEncodeSuccess($data){
//     $array = array(
//             "message" => "success",
//             "code" => "200",
//             "data" => $data
//         );
//     $object = (object)$array;
//     print json_encode($object);
//     exit();
// }
echo json_encode($results);
// $this->jsonEncodeSuccess($results);

// print_r("Winners count: " . count($results['winners']));
// echo "<br/>";
// foreach($results as $key=>$value) {
//     echo $key ."<br />";
//     foreach($value as $data) {
//         echo "&nbsp;&nbsp;bet_id: ".$data['bet_id'] .", ";
//         echo "&nbsp;&nbsp;draw_id: ".$data['draw_id'] .", ";
//         echo "&nbsp;&nbsp;category: ".$data['category'] .", ";
//         echo "&nbsp;&nbsp;digit: ".$data['digit'] .", ";
//         echo "&nbsp;&nbsp;amount: ".$data['amount'] .", ";
//         echo "&nbsp;&nbsp;prize: ".$data['prize_amount'] ."<br />";

//     }
//     // echo "next: ". reLoop($value)."<br />";
//     // // do stuff
// }

// function reLoop($arr) {
    
// }
// foreach($results as $result) {
//     echo $result, '<br>';
//     echo implode_key(",",$result, "BSPH01-03");
// }
// print_r($results[0].BSPH01-03);


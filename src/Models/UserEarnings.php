<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

/**
 * Bets Model
 */
class UserEarnings extends Model
{
    /**
     * Status constant
     */
    const STATUS_PENDING = 'pending';
    const STATUS_WIN = 'win';
    const STATUS_LOSE = 'lose';

    /**
     *  Set the table name
     * @var string
     */
    

    /**
     * Disable this feature
     * @var boolean
     */
    public $timestamps = false;

    public function getTotalPersonEarnings($params,$userlocation):float
    {
        
        $fromDate = new DateTime($params['date_created']);
        $fromDate->setTime(0,0,0);
        $fromDate = $fromDate->format('Y-m-d H:i:s');

        $from = $fromDate;
        $to = $params['date_created'];
        
        // $from = '2022-05-31 00:00:00';
        // $to = '2022-05-31 23:18:26';
        // $results = $this->join('bets', 'bets.user_id', '=', 'users.id')
        // ->select('users.province_id', 'bets.*')
        // ->whereBetween('bets.date_created', [$from, $to])
        // ->where('bets.draw_id', '=', $params['draw_number'])
        // ->where('users.province_id', '=', $userlocation)
        // ->get();

        $results = $this->whereBetween('updated_date', [$from, $to])
                        ->where('draw_id', $params['draw_number'])
                        ->where('location', $userlocation)
                        ->where('type', 'Personal')
                        ->orderByDesc('id')
                        ->get();

        $total_bet = 0;
        
        foreach ($results as $earn) {
            
                $total_bet += (float)$earn->amount;
            
        }
      
        return empty($results) ? 0 : $total_bet;
       
    }


    public function getTotalResidualEarnings($params,$userlocation):float
    {
        
        $fromDate = new DateTime($params['date_created']);
        $fromDate->setTime(0,0,0);
        $fromDate = $fromDate->format('Y-m-d H:i:s');

        $from = $fromDate;
        $to = $params['date_created'];
        
        // $from = '2022-05-31 00:00:00';
        // $to = '2022-05-31 23:18:26';
        // $results = $this->join('bets', 'bets.user_id', '=', 'users.id')
        // ->select('users.province_id', 'bets.*')
        // ->whereBetween('bets.date_created', [$from, $to])
        // ->where('bets.draw_id', '=', $params['draw_number'])
        // ->where('users.province_id', '=', $userlocation)
        // ->get();

        $results = $this->whereBetween('updated_date', [$from, $to])
                        ->where('draw_id', $params['draw_number'])
                        ->where('location', $userlocation)
                        ->where('type', 'Residual')
                        ->orderByDesc('id')
                        ->get();

        $total_bet = 0;
        
        foreach ($results as $earn) {
            
                $total_bet += (float)$earn->amount;
            
        }
        // $resdate = $from ." ".$to;
        // return empty($results) ? 0 : $resdate;
        return empty($results) ? 0 : $total_bet;
        // return $toDate;
        // return $drawno;
    }

    

    protected $table = 'user_earnings';
    /**
     * Grab to get users or agents details
     * @return App\Models\User
     */
    // public function user()
    // {
    //     return User::firstWhere('user_id_code', $this->agent_code);
    // }
}
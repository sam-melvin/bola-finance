<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Digital Tally model
 */
class Winners extends Model
{
    /**
     * Status constant
     */
  
    public function getTotalPayout($drawid,$location)
    {
        
       
        
        $results = $this->where('win_num_id', $drawid)
                        ->where('location', $location)
                        ->orderByDesc('id')
                        ->get();

        $total_payout = 0;
        
        foreach ($results as $payout) {
            
                $total_payout += $payout->prize_amount;
            
        }
        
        return empty($results) ? 0 : $total_payout;
        // return $toDate;
        // return $drawno;
    }


    public function getTotalWinners($drawid,$location)
    {
        
       
        
        $results = $this->where('win_num_id', $drawid)
                        ->where('location', $location)
                        ->orderByDesc('id')
                        ->get();

        return empty($results) ? 0 : count($results);
        // return $toDate;
        // return $drawno;
    }

    /**
     *  Set the table name
     * @var string
     */
    protected $table = 'winner_list';

    /**
     * Disable this feature
     * @var boolean
     */
    public $timestamps = false;


    /**
     * Grab to get users or agents details
     * @return App\Models\User
     */
    // public function user()
    // {
    //     return User::firstWhere('user_id_code', $this->agent_code);
    // }
}
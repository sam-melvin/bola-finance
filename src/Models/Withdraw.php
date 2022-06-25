<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Digital Tally model
 */
class Withdraw extends Model
{
    /**
     * Status constant
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_DECLINED = 'declined';


    public function getWithdrawReq ($uid,$status) {
        $result = $this->join('users', 'user_withdraw.user_id', '=', 'users.id')
        ->select('user_withdraw.*', 'users.first_name', 'users.last_name', 'users.address')
        ->where('user_withdraw.status', '=', $status)
        ->get();


        return empty($result) ? 'no data' : $result;
    }
    /**
     *  Set the table name
     * @var string
     */
    protected $table = 'user_withdraw';

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
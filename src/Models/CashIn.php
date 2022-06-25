<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Digital Tally model
 */
class CashIn extends Model
{
    /**
     * Status constant
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_DECLINED = 'declined';


    public function getCashinReq ($code,$status) {
        $result = $this->join('users', 'user_cash_in.user_id', '=', 'users.id')
        ->select('user_cash_in.*', 'users.first_name', 'users.last_name', 'users.address')
        ->where('user_cash_in.status', '=', $status)
        ->where('user_cash_in.loader_id', '=', $code)
        ->get();


        return empty($result) ? 'no data' : $result;
    }

    public function getCashinLogs ($code) {
        $result = $this->join('users', 'user_cash_in.user_id', '=', 'users.id')
        ->select('user_cash_in.*', 'users.first_name', 'users.last_name', 'users.address')
        ->where('user_cash_in.status', '=', 'sent')
        ->orWhere('user_cash_in.status', '=','declined')
        ->where('user_cash_in.loader_id', '=', $code)
        ->get();


        return empty($result) ? 'no data' : $result;
    }
    /**
     *  Set the table name
     * @var string
     */
    protected $table = 'user_cash_in';

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
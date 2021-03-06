<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

/**
 * Users model
 */
class BolaUsers extends Model
{

  

    public function getBettorUsers()
    {
        /**
         * get latest balance information
         */
        $result = $this->orderByDesc('id')
                    ->get();
            
        
        return empty($result) ? 'no data' : $result;
    }

    public function getUserName($id)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('id', $id)
            ->orderByDesc('id')
            ->first();
        
        $fname = $result->first_name. ' '.$result->last_name;
        return empty($result) ? '' : $fname;
    }

    public function getUserUserName($id)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('id', $id)
            ->orderByDesc('id')
            ->first();
        
       
        return empty($result) ? '' : $result->username;
    }

    public function getUserNameByCode($code)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('invitation_code', $code)
            ->orderByDesc('id')
            ->first();
        
        $fname = $result->first_name. ' '.$result->last_name;
        return empty($result) ? '' : $fname;
    }

    public function getUserID($username)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('username', $username)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? '' : $result->id;
    }

    public function getUserCode($username)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('username', $username)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? '' : $result->invitation_code;
    }
    
    /**
     * Set the table name
     * @var string
     */
    protected $table = 'users';

    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'first_name', 'first_name'
    ];

    public $active = array(
        '0' => 'Offline',
        '1' => 'Online'
    );

    /**
     * Do not manage the datetime columns we dont have them yet
     * TODO:
     *  add those columns
     * @var boolean
     */
    public $timestamps = false;
}
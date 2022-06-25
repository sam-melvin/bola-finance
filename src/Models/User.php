<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Users model
 */
class User extends Model
{

    const USER_ADMIN = '1';
    const USER_STAFF = '2';
    const USER_LOADER = '3';
    const USER_INVESTOR = '4';
    const USER_FINANCE = '5';

    public function getAdminUsers()
    {
        /**
         * get latest balance information
         */
        $result = $this->orderByDesc('type')
                    ->get();
            
        
        return empty($result) ? 'no data' : $result;
    }
    /**
     * Set the table name
     * @var string
     */
    protected $table = 'admin_user';

    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'code', 'username', 'email', 'phone_no', 'gcash_no', 'full_name',
        'assign_location','type'
    ];

    public function jsonEncodeErrors($error){
        $array = array(
                "message" => "Failed",
                "code" => "199",
                "errorMessages" => $error
            );
        $object = (object)$array;
        print json_encode($object);
        exit();
    }
    

    public function getUserName($id)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('id', $id)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? '' : $result->full_name;
    }

    public function getUserCode($username)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('username', $username)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? '' : $result->code;
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

    public function jsonEncodeSuccess($data){
        $array = array(
                "message" => "success",
                "code" => "200",
                "data" => $data
            );
        $object = (object)$array;
        print json_encode($object);
        exit();
    }


    public $statuses = array(
        '1' => 'Admin',
        '2' => 'Staff',
        '3' => 'Loader',
        '4' => 'Investor',
        '5' => 'Finance',
        '6' => 'BPO'
    );

    /**
     * Do not manage the datetime columns we dont have them yet
     * TODO:
     *  add those columns
     * @var boolean
     */
    public $timestamps = false;
}
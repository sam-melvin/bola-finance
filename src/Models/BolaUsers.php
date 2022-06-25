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
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Balance model
 */
class Countries extends Model
{
    /**
     * map for the created at property
     */
   

    /**
     * map for the updated at property
     */
 


    /**
     * Get users current balance
     * @param App\Models\User $user
     * @return float
     */
    public function getCountry($pid)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('id', $pid)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? '' : $result->country;
    }

    /**
     * Update the Users balance information
   
     */
    
    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'id', 'country'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'countries';
}

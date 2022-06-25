<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Balance model
 */
class Province extends Model
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
    public function getProvince($pid)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('id', $pid)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? '' : $result->province;
    }

    
    /**
     * Update the Users balance information
   
     */
    
    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'id', 'province'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'province';
}

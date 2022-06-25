<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Balance model
 */
class Live extends Model
{
    /**
     * map for the created at property
     */
    const CREATED_AT = 'created';

    /**
     * map for the updated at property
     */
    const UPDATED_AT = 'modified';


    /**
     * Get users current balance
     * @param App\Models\User $user
     * @return float
     */
    public function getLive()
    {
        /**
         * get latest balance information
         */
        $result = $this->where('live', 1)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? 0 : $result;
    }

    /**
     * Update the Users balance information
     */
   

    /**
     * Set the fillable rules
     * @var array
     */
   

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'live';
}

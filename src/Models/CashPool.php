<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Journal;


/**
 * Balance model
 */
class CashPool extends Model
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
    
    public function getCashPool()
    {
        /**
         * get latest balance information
         */
        $result = $this->where('id', 1)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? 0 : $result->balance;
    }

    /**
     * Update the Users balance information
     * @param Journal $journal
     */
    // public function updateBalance(Journal $journal)
    // {
    //     /**
    //      * get latest balance information
    //      */
    //     $result = $this->where('user_id', $journal->user_id)
    //         ->orderByDesc('id')
    //         ->first();

    //     if (empty($result)) {
    //         $this->create([
    //             'user_id' => $journal->user_id,
    //             'amount' => $journal->amount,
    //         ]);
    //     } else {
    //         $amount = $result->amount;

    //         if (Journal::ENTRY_TYPE_CREDIT === $journal->entry_type) {
    //             echo 'cr';
    //             $amount += $journal->amount;
    //         } else {
    //             echo 'dt';
    //             $amount -= $journal->amount;
    //         }

    //         $this->create([
    //             'user_id' => $journal->user_id,
    //             'amount' => $amount,
    //         ]);
    //     }
    // }

    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'user_id', 'balance'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'cash_pool';
}

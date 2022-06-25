<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Journal;


/**
 * Balance model
 */
class Wallet extends Model
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
    public function getBalance($user): float
    {
        /**
         * get latest balance information
         */
        $result = $this->where('admin_id', $user->id)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? 0 : $result->balance;
    }

    /**
     * Update the Users balance information
    //  * @param Journal $journal
     */
    public function updateWallet($trans)
    {
        /**
         * get latest balance information
         */
        
        $cashpool =  $trans['cash_pool'];
        $amount = $trans['amount'];
         $total_cash = $cash_pool + $amount;
         $result = $this->where('admin_id', $trans['admin_id'])
                    ->update(['cash_pool' => $total_cash]);


        // if (empty($result)) {
        //     $this->create([
        //         'user_id' => $journal->user_id,
        //         'amount' => $journal->amount,
        //     ]);
        // } else {
        //     $amount = $result->amount;

        //     if (Journal::ENTRY_TYPE_CREDIT === $journal->entry_type) {
        //         echo 'cr';
        //         $amount += $journal->amount;
        //     } else {
        //         echo 'dt';
        //         $amount -= $journal->amount;
        //     }

        //     $this->create([
        //         'user_id' => $journal->user_id,
        //         'amount' => $amount,
        //     ]);
        // }
    }

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
    protected $table = 'wallet';
}

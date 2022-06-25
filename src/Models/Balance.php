<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Journal;


/**
 * Balance model
 */
class Balance extends Model
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
        $result = $this->where('user_id', $user->id)
            ->orderByDesc('id')
            ->first();
        
        return empty($result) ? 0 : $result->amount;
    }

    /**
     * Update the Users balance information
     * @param Journal $journal
     */
    public function updateBalance(Journal $journal)
    {
        /**
         * get latest balance information
         */
        $result = $this->where('user_id', $journal->user_id)
            ->orderByDesc('id')
            ->first();

        if (empty($result)) {
            $this->create([
                'user_id' => $journal->user_id,
                'amount' => $journal->amount,
            ]);
        } else {
            $amount = $result->amount;

            if (Journal::ENTRY_TYPE_CREDIT === $journal->entry_type) {
                echo 'cr';
                $amount += $journal->amount;
            } else {
                echo 'dt';
                $amount -= $journal->amount;
            }

            $this->create([
                'user_id' => $journal->user_id,
                'amount' => $amount,
            ]);
        }
    }

    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'balances';
}

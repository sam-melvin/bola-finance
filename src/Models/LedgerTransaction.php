<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Ledger Transaction model
 */
class LedgerTransaction extends Model
{
    /**
     * Status constant
     */
    const STATUS_PARTIAL = 'partial';
    const STATUS_FULLY_PAID = 'fully paid';
    const STATUS_DEDUCTION = 'deduction';

    /**
     * Type constant
     */
    const TYPE_DEBIT = 'debit';
    const TYPE_CREDIT = 'credit';

    /**
     * map for the created at property
     */
    const CREATED_AT = 'created';

    /**
     * map for the updated at property
     */
    const UPDATED_AT = 'modified';

    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'ledger_id', 'amount', 'maker', 'status', 'type', 'balance', 'remarks'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'ledger_transactions';
}

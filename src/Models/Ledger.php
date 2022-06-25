<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Ledger model
 */
class Ledger extends Model
{
    /**
     * Status constant
     */
    const STATUS_NEW = 'new';
    const STATUS_PARTIAL = 'partial';
    const STATUS_FULLY_PAID = 'fully paid';

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
        'journal_id', 'user_id', 'recipient', 'amount', 'status'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'ledgers';
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Journal model
 */
class Journal extends Model
{
    /**
     * Status constant
     */
    const STATUS_COMPLETE = 'complete';
    const STATUS_INVALID = 'invalid';
    const STATUS_SUSPENDED = 'suspended';

    /**
     * Item type constant
     */
    const ITEM_TYPE_VIRTUAL = 'virtual';
    const ITEM_TYPE_CASH = 'cash';

    /**
     * Entry type constant
     */
    const ENTRY_TYPE_CREDIT = 'credit';
    const ENTRY_TYPE_DEBIT = 'debit';

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
        'performed_by', 'user_id', 'entry_type', 'amount', 'item_type', 'status',
        'remarks'
    ];

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'journals';
}

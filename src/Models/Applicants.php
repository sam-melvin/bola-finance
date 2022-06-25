<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Digital Tally model
 */
class Applicants extends Model
{
    /**
     * Status constant
     */
    const STATUS_PENDING = 'pending';
    const STATUS_WIN = 'verified';
    const STATUS_LOSE = 'declined';

    /**
     *  Set the table name
     * @var string
     */
    protected $table = 'loader_applicants';

    /**
     * Disable this feature
     * @var boolean
     */
    public $timestamps = false;


    /**
     * Grab to get users or agents details
     * @return App\Models\User
     */
    // public function user()
    // {
    //     return User::firstWhere('user_id_code', $this->agent_code);
    // }
}
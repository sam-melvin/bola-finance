<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Users Access
 */
class UsersAccess extends Model
{
    /**
     * Date format constant
     */
    const DATE_FORMAT_SHORT_DATE = 'Y-m-d';
    const DATE_FORMAT_NICE = 'F d, Y (l) h:i:s A';

    /**
     * last seen date time information
     * @var DateTime
     */
    private $lastSeenDatetime = null;

    /**
     * Status constant
     */
    const STATUS_ONLINE = 'Online';
    const STATUS_OFFLINE = 'Offline';

    /**
     * Status indicates whether online or offline
     * @var boolean
     */
    private $status = false;

    /**
     * map for the created at property
     */
    const CREATED_AT = 'date_created';

    /**
     * map for the updated at property
     */
    const UPDATED_AT = 'modified';

    /**
     * Set the table name
     * @var string
     */
    protected $table = 'users_access';

    /**
     * Set the fillable rules
     * @var array
     */
    protected $fillable = [
        'user_id', 'username','full_name','ip_address', 'agent','type','page','last_page'
    ];


    /**
     * getAccess get the users access information
     * @param Users $user
     * @return void
     */
    public function getAccess(User $user): void
    {
        $currentAccess = $this->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->first();

        /**
         * return immediately
         */
        if (empty($currentAccess)) {
            $this->status = false;
            $this->lastSeenDatetime = null;
            return;
        }

        // get current date
        $now = date(self::DATE_FORMAT_SHORT_DATE);
        // check with current date
        if ($now === $currentAccess->created->format(self::DATE_FORMAT_SHORT_DATE)) {
            $this->status = true;
            $this->lastSeenDatetime = $currentAccess->created;
        } else {
            $this->lastSeenDatetime = $currentAccess->created;
        }
    }


    /**
     * getStatus Get the users access status
     * @return string
     */
    public function getStatus(): string
    {
        return ($this->status) ? self::STATUS_ONLINE : self::STATUS_OFFLINE;
    }


    /**
     * getLastseen Get the last seen information
     * @return DateTime|null
     */
    public function getLastseen()
    {
        return $this->lastSeenDatetime;
    }
}
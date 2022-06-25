<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTime;

/**
 * Winning Number model
 */
class WinningNumber extends Model
{
    /**
     *  Set the table name
     * @var string
     */
    protected $table = 'winning_numbers';

    /**
     * Disable this feature
     * @var boolean
     */
    public $timestamps = false;


    /**
     * Get current next draw number
     * @return int
     */
    public static function getNextDrawNumber(): int
    {
        $now = new DateTime('now');
        $result = self::where('draw_date', $now->format('Y-m-d'))
            ->orderByDesc('id')
            ->first();

        return empty($result) ? 1 : ++$result->draw_number;
    }
}
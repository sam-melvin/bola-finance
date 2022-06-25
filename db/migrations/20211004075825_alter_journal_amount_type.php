<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AlterJournalAmountType extends AbstractMigration
{
    /**
     * Change the amount column from float to decimal(65,2)
     * to provide support for large amounts
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('journals');

        $table->changeColumn('amount', 'decimal', [
            'precision' => 65,
            'scale' => 2,
            'signed' => false,
            'default' => 0
        ])
        ->save();
    }
}

<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLedgers extends AbstractMigration
{
    /**
     * Create the ledgers table
     *
     * This table will contain ledgers information which is mainly connected to
     * journals table
     *
     * This table aims to provide and describe payments on behalf of the journal
     * transaction
     *
     * status column values
     *  - new
     *  - partial
     *  - fully paid
     *
     * amount denotes the updated amount due from the recipient also reflects the data we
     * have at ledger_transactions
     *
     * only Credit Journal.entry_type records will be added here
     *
     */
    public function change(): void
    {
        $table = $this->table('ledgers');
        $table
            ->addColumn('journal_id', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('recipient', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('amount', 'decimal', [
                'precision' => 65,
                'scale' => 2,
                'signed' => false,
                'default' => 0
            ])
            ->addColumn('status', 'string', [
                'limit' => 30,
                'null' => false
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => true
            ]);
        $table->create();
    }

    /**
     * remove table when when rollback is called
     * @return void
     */
    public function down(): void
    {
        $this->table('ledgers')->drop()->save();
    }
}

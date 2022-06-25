<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLedgerTransactions extends AbstractMigration
{
    /**
     * Create the ledger_transactions table
     *
     * This table will contain ledger transaction records made for the specific
     * ledger record
     *
     * This table aims to collect payment or deduction records made on the parent ledger
     * record.
     *
     * maker is a user_id field describe who made the transaction
     *
     * status column values
     *  - partial
     *  - fully paid
     *  - deduction
     *
     * type column values
     *  - credit
     *  - debit
     *
     * balance reflects the remaining balance from the parent ledger
     *
     */
    public function change(): void
    {
        $table = $this->table('ledger_transactions');
        $table
            ->addColumn('ledger_id', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('amount', 'decimal', [
                'precision' => 65,
                'scale' => 2,
                'signed' => false,
                'default' => 0
            ])
            ->addColumn('maker', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('status', 'string', [
                'limit' => 30,
                'null' => false
            ])
            ->addColumn('type', 'string', [
                'limit' => 8,
                'null' => false
            ])
            ->addColumn('balance', 'decimal', [
                'precision' => 65,
                'scale' => 2,
                'signed' => false,
                'default' => 0
            ])
            ->addColumn('remarks', 'text', [
                'null' => true,
                'default' => null
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

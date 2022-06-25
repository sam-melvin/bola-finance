<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersAccess extends AbstractMigration
{
    /**
     * Create the users_access table
     *
     * This table will contain user last login information
     */
    public function change(): void
    {
        $table = $this->table('users_access');
        $table
            ->addColumn('user_id', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('ip_address', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('agent', 'string', [
                'limit' => 255,
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
        $this->table('users_access')->drop()->save();
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement('ALTER TABLE products MODIFY image LONGBLOB NULL');

        if (Schema::hasTable('product_images')) {
            DB::statement('ALTER TABLE product_images MODIFY image LONGBLOB NOT NULL');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement('ALTER TABLE products MODIFY image BLOB NULL');

        if (Schema::hasTable('product_images')) {
            DB::statement('ALTER TABLE product_images MODIFY image BLOB NOT NULL');
        }
    }
};

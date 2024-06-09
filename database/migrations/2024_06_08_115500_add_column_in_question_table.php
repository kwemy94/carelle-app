<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                if (!Schema::hasColumn('questions', 'type')) {
                    $table->tinyInteger('type')->nullable()->comment("1 =perception, 0 = Importance, 2 = attentes");
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                if (Schema::hasColumn('questions', 'type')) {
                    $table->dropColumn('type');
                }
            });
        }
    }
};

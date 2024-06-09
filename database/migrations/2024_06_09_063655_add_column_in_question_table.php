<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('answers')) {
            Schema::table('answers', function (Blueprint $table) {
                if (!Schema::hasColumn('answers', 'name')) {
                    $table->string('name')->nullable();
                }
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('answers')) {
            Schema::table('answers', function (Blueprint $table) {
                if (Schema::hasColumn('answers', 'name')) {
                    $table->dropColumn('name');
                }
            });
        }
    }
};

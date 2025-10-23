<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Add FULLTEXT index for MySQL
            // Note: Works on InnoDB (MySQL 5.6+)
            $table->fullText(['title', 'description']);
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropFullText(['title']);
        });
    }
};

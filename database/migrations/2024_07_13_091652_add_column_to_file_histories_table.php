<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('file_histories', function (Blueprint $table) {
            $table->text('md5_hash')->after('entries_amount')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('file_histories', function (Blueprint $table) {
            $table->dropColumn('md5_hash');
        });
    }
};

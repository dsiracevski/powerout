<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('file_histories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('entries_amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_histories');
    }
};

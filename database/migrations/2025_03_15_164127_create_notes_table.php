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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->string('slug')->unique();
            $table->longText('description');
            $table->date('reminder_date');
            $table->enum('priority',['default','very low','low','medium','high','very high'])->default('default');
            $table->enum('permission',['private','public'])->default('public');
            $table->boolean('pin')->default(0);
            $table->boolean('favourite')->default(0);
            $table->foreignId('folder_id')->cascadeOnDelete();
            $table->softDeletesDatetime();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

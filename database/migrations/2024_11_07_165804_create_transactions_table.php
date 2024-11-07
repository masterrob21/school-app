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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code');
            $table->foreignId('ledger_id');
            $table->date('valued_date');
            $table->dateTime('entry_date');
            $table->float('debit');
            $table->float('credit');
            $table->string('description');
            $table->float('balance');
            $table->foreignId('branch_id');
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
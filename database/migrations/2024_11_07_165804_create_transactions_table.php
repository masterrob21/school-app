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
            $table->foreignId('ledger_account_id');
            $table->date('valued_date');
            $table->dateTime('entry_date');
            $table->float('debit');
            $table->float('credit');
            $table->string('description');
            $table->float('balance')->default(0);
            $table->foreignId('branch_id');
            $table->foreignId('user_id');
            $table->string('currency_id');
            $table->foreignId('payment_mode_id');
            $table->foreignId('transaction_type_id');
            $table->foreignId('program_id');
            $table->foreignId('corresponding_ledger_account_id');
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
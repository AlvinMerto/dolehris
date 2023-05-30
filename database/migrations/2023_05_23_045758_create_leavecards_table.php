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
        Schema::create('leavecards', function (Blueprint $table) {
            $table->increments("leavecardpk");
            $table->string("particulartype");
            $table->integer("particularid");
            $table->string("operand");
            $table->string("particulars_days");
            $table->string("particulars_hrs");
            $table->string("particulars_mins");
            $table->string("leave_earned");
            $table->string("leave_withpay");
            $table->string("leave_balance");
            $table->string("leave_wopay");
            $table->string("leavecardtype");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leavecards');
    }
};

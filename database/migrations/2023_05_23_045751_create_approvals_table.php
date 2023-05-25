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
        Schema::create('approvals', function (Blueprint $table) {
            $table->increments("approvalid");
            $table->string("fkidfromtbl");
            $table->string("fromprimaryfield");
            $table->string("fromtable");
            $table->string("approvalcode");
            $table->string("tobeapprovedby");
            $table->boolean("isapproved");
            $table->string("reasonfordisapproval");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};

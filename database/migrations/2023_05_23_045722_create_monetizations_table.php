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
        Schema::create('monetizations', function (Blueprint $table) {
            $table->increments("monetizationpk");
            $table->integer("leaveapplicationid");
            $table->boolean("ismonetize")->nullable();
            $table->boolean("isterminalleave")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monetizations');
    }
};

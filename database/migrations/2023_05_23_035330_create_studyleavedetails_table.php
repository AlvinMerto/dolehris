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
        Schema::create('studyleavedetails', function (Blueprint $table) {
            $table->increments("studyleavedetailspk");
            $table->integer("leaveapplicationid");
            $table->boolean("iscompletionofgradstud");
            $table->boolean("isbarboardexamrev");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studyleavedetails');
    }
};

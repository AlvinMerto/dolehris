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
        Schema::create('vacationleavedetails', function (Blueprint $table) {
            $table->increments("vacationleavedetailspk");
            $table->integer("leaveapplicationid");
            $table->integer("vacationlocationid")->nullable();
            $table->string("specify")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacationleavedetails');
    }
};

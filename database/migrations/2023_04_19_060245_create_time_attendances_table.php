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
        Schema::create('time_attendances', function (Blueprint $table) {
            $table->increments("taaid");
            $table->integer("biometricid");
            $table->datetime("theattendance");
            $table->string("cstatus");
            $table->string("timeactual");
            $table->integer("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_attendances');
    }
};

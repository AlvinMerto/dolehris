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
        Schema::create('personnels', function (Blueprint $table) {
            $table->increments("perid");
            $table->integer("biometricid")->nullable();
            $table->integer("user_id")->nullable();
            $table->string("employeeid")->nullable();
            $table->string("fname")->nullable();
            $table->string("mname")->nullable();
            $table->string("lname")->nullable();
            $table->string("gender")->nullable();
            $table->string("email")->nullable();
            $table->integer("employment_type_id")->nullable();
            $table->integer("area_office_id")->nullable();
            $table->integer("position_id")->nullable();
            $table->integer("office_id")->nullable();
            $table->integer("division_id")->nullable();
            $table->integer("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};

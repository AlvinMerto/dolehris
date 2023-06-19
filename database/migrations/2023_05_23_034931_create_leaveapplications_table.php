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
        Schema::create('leaveapplications', function (Blueprint $table) {
            $table->increments("leaveapplicationpk");
            $table->integer("leavetypeid");
            $table->string("thedateinquestion");
            $table->integer("numberofdays");
            $table->integer("personnelid");
            $table->integer("commutationid")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaveapplications');
    }
};

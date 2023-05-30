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
        Schema::create('tardyundertimetbls', function (Blueprint $table) {
            $table->increments("tardyundertimepk");
            $table->string("typeofitem");
            $table->string("thevalue");
            $table->string("personnelid");
            $table->string("thedateinquestion");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tardyundertimetbls');
    }
};

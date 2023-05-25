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
        Schema::create('validationcodes', function (Blueprint $table) {
            $table->increments("validcode");
            $table->string("typeofdocument");
            $table->string("thecode");
            $table->integer("personnelid");
            $table->integer("detailsid");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validationcodes');
    }
};

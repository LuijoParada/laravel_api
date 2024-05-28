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
        Schema::create('styleconfig', function (Blueprint $table) {
            $table->id();
            $table->string('primaryColor');
            $table->string('secondaryColor');
            $table->string('tertiaryColor');
            $table->string('titleColor');
            $table->string('subtitleColor');
            $table->string('pColor');
            $table->string('bgBtnColor');
            $table->string('texBtnColor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('styleconfig');
    }
};

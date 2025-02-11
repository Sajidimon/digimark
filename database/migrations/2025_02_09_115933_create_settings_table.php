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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('HeaderLogo')->nullable();
            $table->string('herobgimage')->nullable();
            $table->string('heading')->nullable();
            $table->string('SubHeading')->nullable();
            $table->string('ButtonLink')->nullable();
            $table->string('FooterLogo')->nullable();
            $table->text('FooterDescription')->nullable();
            $table->string('Footerfb')->nullable();
            $table->string('Footeryt')->nullable();
            $table->string('Footerinsta')->nullable();
            $table->string('copyright')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

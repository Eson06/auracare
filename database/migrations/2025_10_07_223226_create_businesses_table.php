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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('business_name');
            $table->string('business_address');
            $table->string('business_permit');
            $table->string('expiration_date');
            $table->string('email');
            $table->string('contact_number');
            $table->string('address');
            $table->string('picture')->nullable();
            $table->string('qr')->nullable();
            $table->string('gcash_number')->nullable();
            $table->string('gcash_name')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};

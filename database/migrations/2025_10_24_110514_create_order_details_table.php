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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('name_service');
            $table->string('type_service');
            $table->decimal('price', 10, 2);
            $table->date('date_schdedule');
            $table->string('selected_time');
            $table->string('picture')->nullable();
            $table->decimal('amount_paid', 10, 2);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

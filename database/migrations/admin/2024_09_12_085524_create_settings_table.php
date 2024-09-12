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
            $table->string('address', 255)->nullable();
            $table->string('contact_name', 255)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->time('meal_booking_last_time')->nullable();
            $table->time('meal_booking_alert_time')->nullable();
            $table->text('meal_booking_alert_text_for_all')->nullable();
            $table->integer('meal_booking_minimum_amount')->nullable();
            $table->string('shut_down_app')->default('active')->nullable();
            $table->string('shut_down_reason',255)->nullable();
            $table->text('notice',255)->nullable();

            $table->string('slug', 255)->nullable();
            $table->bigInteger('creator')->nullable();
            $table->string('status')->default('active');
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

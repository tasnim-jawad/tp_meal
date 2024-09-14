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
        Schema::create('daily_bajars', function (Blueprint $table) {
            $table->id();
            $table->string('group_id',100)->nullable();
            $table->string('title',30)->nullable();
            $table->integer('qty')->nullable();
            $table->enum('unit', ['kg', 'gm', 'liter', 'piece'])->nullable();
            $table->float('price')->nullable();
            $table->float('total')->nullable();
            $table->date('date')->nullable();
            $table->string('comment',100)->nullable();

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
        Schema::dropIfExists('daily_bajars');
    }
};

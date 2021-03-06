<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engagement_id')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('class_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('attendances');
    }
};

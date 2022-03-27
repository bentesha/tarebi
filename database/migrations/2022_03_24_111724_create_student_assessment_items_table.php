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
        Schema::create('student_assessment_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_key', 255)->nullable();
            $table->string('item_value', 255)->nullable();
            $table->enum('criteria', [
                'Pre-Incubation', 'Incubation', 'Post-Incubation'
            ])->nullable();
            $table->string('contribution', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('student_assessment_items');
    }
};

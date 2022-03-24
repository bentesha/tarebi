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
        Schema::create('class_assessments', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->bigInteger('class_id')->nullable();
            $table->enum('type', ['Pre-Incubation', 'Incubation', 'Post-Incubation'])->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('class_assessments');
    }
};

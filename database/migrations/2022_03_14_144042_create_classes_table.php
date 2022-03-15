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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('number', 100)->nullable();
            $table->enum('name', [
                'Pre-Incubation', 'Incubation', 'Post-Incubation'
            ])->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('admission_id')->nullable();
            $table->bigInteger('program_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['Open', 'Closed'])->nullable()->default('Open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('classes');
    }
};

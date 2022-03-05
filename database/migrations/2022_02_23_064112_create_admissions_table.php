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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->bigInteger('program_id')->nullable();
            $table->text('description');
            $table->string('period', 255)->nullable();
            $table->string('batch', 255)->nullable();
            $table->date('opening_date');
            $table->date('closing_date');
            $table->bigInteger('created_by')->nullable();
            $table->enum('status', ['Open', 'Closed']);
            $table->enum('locked', [0, 1])->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admissions');
    }
};

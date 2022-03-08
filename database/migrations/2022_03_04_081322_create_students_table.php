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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admission_id')->nullable();
            $table->bigInteger('admission_application_id')->nullable();
            $table->bigInteger('program_id')->nullable();
            $table->string('number', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('gender', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('region', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('ward', 100)->nullable();
            $table->string('village_street', 100)->nullable();
            $table->string('id_type', 100)->nullable();
            $table->string('id_number', 100)->nullable();
            $table->string('marital_status', 100)->nullable();
            $table->string('education', 255)->nullable();
            $table->string('education_other', 255)->nullable();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('email1', 255)->nullable();
            $table->string('email2', 255)->nullable();
            $table->enum('status', ['Selected', 'Enrolled'])->nullable()->default('Selected');
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
        Schema::dropIfExists('students');
    }
};

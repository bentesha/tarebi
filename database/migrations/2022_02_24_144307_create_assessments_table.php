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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admission_application_id')->nullable();
            $table->integer('age_range')->nullable();
            $table->integer('business_idea')->nullable();
            $table->integer('solar_related_business')->nullable();
            $table->integer('knowledgeable_about_solar_installations')->nullable();
            $table->integer('graduated_from_technical_training')->nullable();
            $table->integer('business_experience')->nullable();
            $table->float('screening_score', 3, 1)->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('assessments');
    }
};

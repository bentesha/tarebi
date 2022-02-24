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
        Schema::create('admission_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('admission_id')->nullable();
            $table->bigInteger('staff_id')->nullable();
            $table->string('campaign_type', 255)->nullable();
            $table->string('institution', 255)->nullable();
            $table->string('location')->nullable();
            $table->date('campaign_date');
            $table->integer('potential_students_reached')->nullable();
            $table->integer('potential_applicants')->nullable();
            $table->enum('status', ['NEW', 'EXECUTED', 'DISCARDED'])->default('NEW')->nullable();
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
        Schema::dropIfExists('admission_campaigns');
    }
};

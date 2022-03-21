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
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 255)->nullable();
            $table->text('body')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->enum('approved', ['Yes', 'No'])->nullable()->default('Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sms_templates');
    }
};

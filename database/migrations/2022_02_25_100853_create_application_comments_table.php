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
        Schema::create('application_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admission_application_id')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->string('stage', 100)->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('application_comments');
    }
};

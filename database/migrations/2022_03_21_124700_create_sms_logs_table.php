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
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sms_campaign_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('type', 100)->nullable();
            $table->text('message')->nullable();
            $table->integer('characters')->nullable();
            $table->integer('length')->nullable();
            $table->enum('status', ['Pending', 'Sent', 'Failed'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sms_logs');
    }
};

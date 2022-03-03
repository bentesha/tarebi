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
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admission_id')->nullable();
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
            $table->string('communication_subscription_method', 255)->nullable();
            $table->string('communication_subscription_method_other', 255)->nullable();
            $table->enum('previous_subscription_tarebi_services', ['Ndiyo', 'Hapana'])->nullable();
            $table->enum('have_dependants', ['Ndiyo', 'Hapana'])->nullable();
            $table->integer('number_of_dependants')->nullable();
            $table->enum('physical_disability', ['Ndiyo', 'Hapana'])->nullable();
            $table->string('physical_disability_type', 255)->nullable();
            $table->decimal('business_average_income', 12, 2)->nullable();
            $table->string('other_income_activities', 255)->nullable();
            $table->decimal('other_income_activities_income', 12, 2)->nullable();
            $table->enum('employed', ['Ndiyo', 'Hapana'])->nullable();
            $table->string('employer_name', 255)->nullable();
            $table->enum('have_capital_asset', ['Ndiyo', 'Hapana'])->nullable();
            $table->decimal('capital_asset_value', 12, 2)->nullable();
            $table->enum('have_savings', ['Ndiyo', 'Hapana'])->nullable();
            $table->decimal('savings_amount', 12, 2)->nullable();
            $table->string('savings_method', 255)->nullable();
            $table->string('savings_method_other', 255)->nullable();
            $table->enum('have_loan', ['Ndiyo', 'Hapana'])->nullable();
            $table->decimal('total_loan_amount', 12, 2)->nullable();
            $table->string('loan_source', 255)->nullable();
            $table->string('loan_source_other', 255)->nullable();
            $table->enum('have_group', ['Ndiyo', 'Hapana'])->nullable();
            $table->text('group_details')->nullable();
            $table->enum('doing_business', ['Ndiyo', 'Hapana'])->nullable();
            $table->string('business_type', 255)->nullable();
            $table->enum('is_business_yours', ['Ndiyo', 'Hapana'])->nullable();
            $table->enum('is_business_registered', ['Ndiyo', 'Hapana'])->nullable();
            $table->string('business_registration_type', 255)->nullable();
            $table->string('business_registration_type_other', 255)->nullable();
            $table->enum('business_under_registration_process', ['Ndiyo', 'Hapana'])->nullable();
            $table->integer('business_employees_count')->nullable();
            $table->enum('trained_business_through_incubation', ['Ndiyo', 'Hapana'])->nullable();
            $table->enum('trained_by_tarebi_incubation', ['Ndiyo', 'Hapana'])->nullable();
            $table->text('other_training_from_other_institutes')->nullable();
            $table->string('preferred_training_from_tarebi', 255)->nullable();
            $table->text('preferred_training_from_tarebi_other')->nullable();
            $table->enum('have_smartphone', ['Ndiyo', 'Hapana'])->nullable();
            $table->enum('is_complete', [0, 1])->default(1)->nullable();
            $table->date('submitted_on')->nullable();
            $table->enum('status', [
                'Pending',
                'Screened',
                'Selected',
                'Rejected'
            ])->nullable()->default('Pending');
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
        Schema::dropIfExists('admission_applications');
    }
};

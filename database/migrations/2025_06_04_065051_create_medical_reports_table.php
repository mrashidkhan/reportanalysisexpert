<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('phone_number');
            $table->string('email');
            $table->integer('age');
            $table->enum('report_type', ['blood_report', 'xray', 'mri', 'ultrasound', 'ct_scan', 'other']);
            $table->json('file_paths'); // Store multiple file paths
            $table->text('symptoms')->nullable();
            $table->text('medical_history')->nullable();
            $table->enum('urgency_level', ['normal', 'urgent', 'emergency'])->default('normal');
            $table->boolean('terms_accepted')->default(false);
            $table->enum('status', ['pending', 'analyzing', 'completed', 'cancelled'])->default('pending');
            $table->text('analysis_result')->nullable();
            $table->timestamp('analyzed_at')->nullable();
            $table->unsignedBigInteger('analyzed_by')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('analyzed_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'urgency_level']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_reports');
    }
}

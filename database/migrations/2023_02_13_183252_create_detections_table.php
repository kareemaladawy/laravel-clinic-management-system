<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')
                ->references('patients')
                ->on('id');
            $table->foreignId('doctor_id')
                ->references('doctors')
                ->on('id');
            $table->string('disease');
            $table->string('state');
            $table->longText('notes');
            $table->longText('prescription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detections');
    }
};

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
            $table->foreignId('user_id')
                ->constrained('users');
            $table->foreignUuid('patient_id')
                ->constrained('patients');
            $table->string('disease')
                ->nullable();
            $table->string('state')
                ->nullable();
            $table->string('type')
                ->nullable();
            $table->longText('comments')
                ->nullable();
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

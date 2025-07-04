<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cv_personal_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('job_title')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('marital_status')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('website')->nullable();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->char('health_status', 20)->nullable();
            $table->char('military_status', 20)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};

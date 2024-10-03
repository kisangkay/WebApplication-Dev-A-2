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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('reviewer_user_number');
            $table->foreign('reviewer_user_number')->references('user_number')->on('users');
            $table->integer('reviewee_user_number');
            $table->foreign('reviewee_user_number')->references('user_number')->on('users');
            $table->text('review_submitted');
            $table->integer('reviewee_rated')->nullable();
            $table->integer('assessment_id');
            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

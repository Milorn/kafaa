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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('activity_area_id')->nullable()->constrained('activity_areas')->nullOnDelete();
            $table->string('website')->nullable();
            $table->timestamps();
        });

        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('activity_area_id')->nullable()->constrained('activity_areas')->nullOnDelete();
            $table->string('website')->nullable();
            $table->timestamps();
        });

        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('type');
            $table->string('diploma')->nullable();
            $table->unsignedInteger('years_of_experience')->nullable();
            $table->unsignedInteger('number_of_projects')->nullable();
            $table->unsignedInteger('number_of_metric')->nullable();
            $table->string('professional_status');
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('providers');
        Schema::dropIfExists('experts');
    }
};

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
            $table->string('responsible_name');
            $table->string('responsible_job')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('activity_area_id')->nullable()->constrained('activity_areas')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('responsible_name');
            $table->string('responsible_job')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('activity_area_id')->nullable()->constrained('activity_areas')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('lname');
            $table->string('fname');
            $table->string('email')->nullable();
            $table->foreignId('wilaya_id')->nullable()->constrained('wilayas')->nullOnDelete();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('diploma')->nullable();
            $table->string('professional_status')->nullable();
            $table->string('label');
            $table->unsignedInteger('years_of_experience')->nullable();
            $table->unsignedInteger('number_of_projects')->nullable();
            $table->unsignedInteger('number_of_metric')->nullable();
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

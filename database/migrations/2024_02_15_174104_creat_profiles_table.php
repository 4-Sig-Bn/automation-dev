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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('number_type')->nullable();
            $table->string('number')->nullable();
            $table->string('rank')->nullable();
            $table->string('trade')->nullable();
            $table->string('name')->nullable();
            $table->string('coy')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_gp')->nullable();
            $table->string('height_feet')->nullable();
            $table->string('height_inch')->nullable();
            $table->string('weight')->nullable();
            $table->string('present_address')->nullable();
            $table->string('vil')->nullable();
            $table->string('union')->nullable();
            $table->string('upazila')->nullable();
            $table->string('po')->nullable();
            $table->string('district')->nullable();
            $table->string('distance_from_border')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('enrolment_date')->nullable();
            $table->string('unit_join_date')->nullable();
            $table->string('retirement_date')->nullable();
            $table->string('punishment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained(); // Assuming you have a profile_id field
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('pending'); // Can be 'approved', 'rejected', etc.
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->string('type')->nullable();
            $table->string('reason')->nullable();
            $table->string('applicant_name')->nullable();
            $table->string('ordered_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};

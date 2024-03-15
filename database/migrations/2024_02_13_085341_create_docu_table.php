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
        Schema::create('docu', function (Blueprint $table) {
            $table->id();
            $table->string('branch');
            $table->string('file_name');
            $table->timestamp('upload_date')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null'); // Assuming 'users' is your users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docu');
    }
};

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
       Schema::create('applications', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // Avval ustunni yarating
    $table->text('subject');
    $table->text('message');
    $table->text('file_url')->nullable();
    $table->timestamps();

    // Keyin foreign key qo'shing
    $table->foreign('user_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

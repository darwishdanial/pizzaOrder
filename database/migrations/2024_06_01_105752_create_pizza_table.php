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
        Schema::create('pizza', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('qty');
            $table->double('price',8,2)->default(0.00);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add foreign key constraint
            $table->boolean('is_active')->default(true); // Add boolean 'is_active'
            $table->integer('status')->default(0); // Add integer 'status'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza');
    }
};

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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            // Optional: link to user who posted
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Core listing info
            $table->string('title');
            $table->enum('listing_type', ['rent', 'sale'])->index(); // rent or sale
            $table->decimal('price', 12, 2)->nullable()->index();
            $table->string('currency', 3)->default('PKR');

            // Location & specs
            $table->string('city')->nullable()->index();
            $table->string('address')->nullable();
            $table->double('area_size')->nullable();
            $table->string('area_unit', 20)->nullable(); // e.g., marla, kanal, sqft
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();

            // Description
            $table->text('description')->nullable();

            // Contact info
            $table->string('contact_name');
            $table->string('contact_phone', 30);
            $table->string('whatsapp_phone', 30)->nullable();
            $table->string('contact_email', 150)->nullable();

            // Media
            $table->string('main_image')->nullable(); // stored via Storage::disk('public')
            $table->json('images')->nullable();       // extra images as JSON array of paths

            // Status
            $table->boolean('is_published')->default(true)->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->string('brand');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->integer('weight_or_volume');
            $table->string('country_of_manufacture');
            $table->integer('stock')->default(1);
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('discounted_price')->nullable();
            $table->unsignedInteger('discount_percentage')->nullable();

            $table->softDeletes();
            $table->innoDb();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};

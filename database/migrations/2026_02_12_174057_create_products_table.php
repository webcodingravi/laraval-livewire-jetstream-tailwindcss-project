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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('old_price',10,2)->default(0);
            $table->integer('discount')->nullable();
            $table->decimal('price',10,2)->default(0);
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('specifications')->nullable();
            $table->integer('quantity')->default(0);
            $table->tinyInteger('is_hot')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->enum('status',['active','deactive'])->default('active');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

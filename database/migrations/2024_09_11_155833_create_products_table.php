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
            $table->string('name');
            $table->string('slug');
            $table->integer('min');
            $table->integer('max');
            $table->integer('type');
            $table->bigInteger('order')->default(1);
            $table->bigInteger('barcode');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->text('image')->nullable();
            $table->string('price');
            $table->bigInteger('stock')->default(0);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
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

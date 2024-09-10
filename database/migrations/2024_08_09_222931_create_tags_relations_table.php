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
        Schema::create('tags_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->string('type');
            $table->bigInteger('relation_id');
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_relations');
    }
};

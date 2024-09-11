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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('code_meli');
            $table->string('phone')->nullable();
            $table->bigInteger('status')->default(0);
            $table->text('description')->nullable();
            $table->text('avatar')->nullable();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->foreign('role_id')->references('id')
                ->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

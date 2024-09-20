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
            $table->string('code_meli')->nullable();
            $table->string('father')->nullable();
            $table->string('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('type')->nullable();
            $table->string('license_number')->nullable();
            $table->string('license_date')->nullable();
            $table->string('license_image')->nullable();
            $table->string('phone');
            $table->text('token')->nullable();
            $table->bigInteger('status')->default(1);
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
//]);
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

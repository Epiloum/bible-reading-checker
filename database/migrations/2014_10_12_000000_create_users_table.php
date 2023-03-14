<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('socialite_type', ['kakao', 'naver']);
            $table->string('socialite_uid', 255);
            $table->string('name')->nullable();
            $table->string('nick')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->date('target_date')->nullable();
            $table->enum('division', ['청년1부', '청년2부'])->nullable();
            $table->enum('manager', ['y', 'n'])->default('n');
            $table->enum('has_ticket', ['y', 'n'])->default('y');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['socialite_type', 'socialite_uid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

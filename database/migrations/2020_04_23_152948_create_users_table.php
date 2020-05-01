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
        /**
         * id
         * name
         * email
         * password
         * photo
         * access_token
         * activated
         * activation_token
         * activated_at
         * forgot_password_token
         * device_id
         * last_login
         */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length(60);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('access_token')->nullable();
            $table->integer('activated')->default(0);
            $table->string('activation_token')->length(100)->nullable();
            $table->dateTime('activation_at')->nullable();
            $table->string('forgot_password_token')->length(100)->nullable();
            $table->string('device_id')->length(255)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->nullableTimestamps();
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

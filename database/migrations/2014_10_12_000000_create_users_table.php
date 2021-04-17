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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birthday');
            $table->string('first_name', 190);
            $table->string('last_name', 190);
            $table->string('password', 60);
            $table->string('reset_password', 60)->nullable();
            $table->integer('status')->default(1);
            $table->boolean('flag_delete')->default(0);
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('commune_id');
            $table->rememberToken();
            $table->timestamps();
           
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

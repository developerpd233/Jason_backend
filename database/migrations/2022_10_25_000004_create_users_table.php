<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('identity')->nullable();
            $table->string('interest')->nullable();
            $table->string('age')->nullable();
            $table->string('relation_preference')->nullable();
            $table->string('fav_drink')->nullable();
            $table->string('fav_song')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('my_dislikes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

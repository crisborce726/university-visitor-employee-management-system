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

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->string('course')->nullable();
            $table->timestamps();
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userType');
            $table->string('fname')->default('none');
            $table->string('lname')->default('none');
            $table->string('email')->default('none');
            $table->string('username')->default('none');
            $table->string('contactNo')->nullable();
            $table->string('office')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('post')->nullable();
            $table->string('activity')->nullable();
            $table->string('identification')->nullable();
            $table->text('barcode')->nullable();
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedBigInteger('department_id')->nullable();
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('departmentOffice');
            $table->date('date');
            $table->string('time');
            $table->string('purpose');
            $table->string('visitant');
            $table->string('status');
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });


        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer');

            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('areasOfConcern');
            $table->string('status');
            $table->string('actionTaken');
            $table->string('remarks');
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->time('timeIn');
            $table->string('entrance');
            $table->date('dateIn');
            $table->time('timeOut')->nullable();
            $table->string('ext')->nullable();
            $table->string('visit_department')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('blocklists', function (Blueprint $table) {
            $table->id();
            $table->string('oType');
            $table->string('description');
            $table->date('bldate');
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('blacklists');
    }
}

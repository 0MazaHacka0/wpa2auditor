<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name');
            $table->bigInteger('user_id')->default('0');
            $table->string('essid');
            $table->macAddress('station_mac');
            $table->integer('type');
            $table->binary('task_hash');
            $table->binary('uniq_hash');
            $table->string('net_key')->nullable();
            $table->integer('priority')->default('10');
            $table->integer('agents')->default('0');
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('tasks');
    }
}

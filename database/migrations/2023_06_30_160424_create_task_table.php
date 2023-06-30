<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class  extends Migration
{
    const Task= 'tasks',
          Usertask = 'usertasks',
          todolist = 'todolist';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        self::createUsertaskTable();
        self::createtodolistTable();
        self::createTaskTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
    protected function createTaskTable() {
        Schema::create(self::Task, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('STEPS');
            $table->timestamps();
        });
    }
    protected function createUsertaskTable() {
        Schema::create(self::Usertask, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
    protected function createtodolistTable() {
        Schema::create(self::todolist, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id_users');
            $table->foreignId('fk_id_users')->references('id')->on('Usertask')->onDelete('set null');
            $table->unsignedBigInteger('fk_id_task');
            $table->foreignId('fk_id_task')->references('id')->on('Task')->onDelete('set null');
        });
    }
};

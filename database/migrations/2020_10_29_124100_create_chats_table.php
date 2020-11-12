<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->integer('to')->unsigned()->index();
            $table->integer('from')->unsigned()->index();
            $table->string('type');
            $table->text('message')->nullable();
            $table->integer('ChatSetting_id')->unsigned()->index();
            $table->string('attachment')->nullable();
            $table->dateTime('read')->nullable();
            $table->integer('who')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}

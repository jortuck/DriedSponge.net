<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_servers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("ip");
            $table->integer("port")->default(25565);
            $table->longText("description")->nullable();
            $table->boolean("private")->default(0);
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
        Schema::dropIfExists('mc_servers');
    }
}

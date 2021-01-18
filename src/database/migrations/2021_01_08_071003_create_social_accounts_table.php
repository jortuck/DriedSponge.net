<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('provider')->required();
            $table->string('provider_id')->required()->unique();
            $table->string('provider_username')->nullable();
            $table->string('provider_email')->nullable();
            $table->string('provider_avatar')->nullable();
            $table->string('provider_token')->nullable();
            $table->string('provider_refresh_token')->nullable();
            $table->timestamp('token_expires')->nullable();
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
        Schema::dropIfExists('social_accounts');
    }
}

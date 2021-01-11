<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('sid')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('country', 2);
            $table->string('workspace');
            $table->string('transactional_email');
            $table->string('transactional_phone')->nullable();
            $table->string('timezone');
            $table->boolean('is_active')->default(false);
            $table->json('metadata')->nullable();
            $table->string('payment_gateway')->default('stripe');
            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}

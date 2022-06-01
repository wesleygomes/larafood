<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('profile_id');

            $table->foreign('plan_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->references('id')
                ->on('plans');

            $table->foreign('profile_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->references('id')
                ->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_profile');
    }
};

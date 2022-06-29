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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->uuid('uuid');
            $table->string('identify');
            $table->string('description')->nullable();
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->timestamps();

            $table->foreign('tenant_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->references('id')
                ->on('tenants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
};

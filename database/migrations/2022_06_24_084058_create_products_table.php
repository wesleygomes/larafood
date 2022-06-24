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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->uuid('uuid');
            $table->string('title');
            $table->string('flag');
            $table->string('image');
            $table->double('price', 10, 2);
            $table->text('description');
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->timestamps();

            $table->foreign('tenant_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->references('id')
                ->on('tenants');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
    }
};

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
        //
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->index()->unique()->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('discount')->default(0);
            $table->foreignUuid('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        //
        Schema::dropIfExists('products');
    }
};

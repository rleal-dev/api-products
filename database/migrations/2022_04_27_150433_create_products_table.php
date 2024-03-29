<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('description')->unique();
            $table->foreignId('category_id')->constrained();
            $table->string('dimensions', 100);
            $table->string('code', 100);
            $table->string('reference', 100);
            $table->unsignedInteger('quantity_stock')->default(0);
            $table->unsignedDecimal('price', 10, 2);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

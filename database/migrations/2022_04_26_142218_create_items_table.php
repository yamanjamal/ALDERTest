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

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->collation('utf8_unicode_ci');
            $table->string('description',500)->collation('utf8_unicode_ci');
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('RESTRICT')->onUpdate('cascade');

            $table->boolean('is_available')->default(1);
            $table->boolean('in_orderes')->default(1);
            $table->integer('order')->nullable()->default(null);
            $table->integer('menu_order')->nullable()->default(null);

            $table->bigInteger('menu_cat_id')->nullable()->default(null);

            $table->decimal('monthly_avg',8,2)->default(0.00);
            $table->enum('rate_star',['1','2','3','4','5'])->collation('utf8_unicode_ci')->default('4');

            $table->decimal('sell_price',15,2);
            $table->softDeletes();
            $table->timestamps();
            $table->integer('parent_id')->length(20)->nullable()->default(null);

            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};

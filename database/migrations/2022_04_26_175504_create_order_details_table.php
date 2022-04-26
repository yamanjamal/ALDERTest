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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->decimal('total_price',12,2)->default(0.00);
            $table->integer('count')->default(1);
            $table->boolean('is_fired')->default(0);
            $table->enum('rate_star',['pending','preparing','canceled','done'])->collation('utf8_unicode_ci')->default('pending');
            $table->string('notes',255)->collation('utf8_unicode_ci')->nullable()->default(null);
            $table->double('note_price')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
            $table->time('delay')->nullable()->default(null);
            $table->double('cost',10,2)->nullable()->default(null);

            $table->index('order_id');
            $table->index('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};

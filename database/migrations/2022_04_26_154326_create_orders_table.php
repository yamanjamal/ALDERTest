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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('RESTRICT')->onUpdate('RESTRICT');

            $table->datetime('order_date',0);
            $table->double('total_price',12,2)->default(0.00);

            $table->boolean('payment_state')->default(0);
            $table->enum('payment_method',['card','cash','city_ledger','voucher','credit'])->collation('utf8_unicode_ci')->nullable()->default(null);

            $table->unsignedBigInteger('client_id')->nullable()->default(null);
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('RESTRICT')->onUpdate('RESTRICT');

            $table->enum('status',['pending','preparing','reserved','done','paid','canceled'])->collation('utf8_unicode_ci')->default('pending');
            $table->integer('print_count')->default(0);
            
            $table->integer('customer')->default(1);
            
            $table->unsignedBigInteger('user_id')->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->softDeletes();
            $table->timestamps();
            $table->double('total_cost',10,2)->nullable()->default(null);
            $table->double('total_after_taxes',12,2)->nullable()->default(null);
            $table->double('discount_amount',12,2)->nullable()->default(null);
            $table->double('taxes',10,3)->nullable()->default(null);
            $table->double('consumption_taxs',10,3)->nullable()->default(null);
            $table->double('local_adminstration',10,3)->nullable()->default(null);
            $table->double('rebuild_tax',10,3)->nullable()->default(null);
            $table->string('notes',255)->collation('utf8_unicode_ci')->nullable()->default(null);
            $table->string('client_name',255)->collation('utf8_unicode_ci')->nullable()->default(null);

            $table->index('table_id');
            $table->index('client_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

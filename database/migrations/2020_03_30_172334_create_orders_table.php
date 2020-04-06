<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('user_id');
            $table->uuid('party_id')->nullable();
            $table->unsignedBigInteger('shopify_order_id')->default(0);
            $table->uuid('customer_id');

            $table->string('customer_name')->default('');

            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            $table->enum('status', ['draft', 'pending_payment', 'complete'])->default('draft');

            $table->enum('channel', ['web','ambassador','party'])->default('web');

            
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
            $table->index('user_id');
            $table->index('channel');
            $table->index('customer_id');
            $table->index('status');
            $table->index('created_at');
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
}

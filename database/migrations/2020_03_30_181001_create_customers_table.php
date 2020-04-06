<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('user_id');


            $table->string('firstname');
            $table->string('lastname');

            $table->string('location')->nullable();
            $table->string('country')->nullable();

            $table->string('email')->nullable();

            $table->timestamp('last_order_at')->nullable();
            $table->decimal('total_order_value', 10,2)->default(0);

            $table->timestamps();

            $table->softDeletes();

            $table->primary('id');
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
        Schema::dropIfExists('customers');
    }
}

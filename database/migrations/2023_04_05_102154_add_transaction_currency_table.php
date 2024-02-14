<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txn_id');
            $table->string('txn_currency_type');
            $table->integer('txn_frgn_curr_amount');
            $table->integer('txn_inr_amount');
            $table->float('txn_booking_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_currency', function (Blueprint $table) {
            Schema::dropIfExists('manage_sources');
        });
    }
}

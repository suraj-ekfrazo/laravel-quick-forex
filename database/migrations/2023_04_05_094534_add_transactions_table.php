<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txn_number');
            $table->integer('customer_id');
            $table->string('txn_type');
            $table->integer('booking_purpose_id');
            $table->integer('fund_source_id');
            $table->string('pancard_no');
            $table->string('customer_name');
            $table->string('customer_mobile');
            $table->string('agent_code')->nullable();
            $table->string('agent_name')->nullable();
            $table->tinyInteger('is_otp')->default('0');
            $table->integer('remit_fees')->default(0);
            $table->tinyInteger('is_active')->default('1');
            $table->tinyInteger('kyc_status')->default('0')->comment('0 = pending, 1 = completed, 2 = rejected');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            Schema::dropIfExists('manage_sources');
        });
    }
}

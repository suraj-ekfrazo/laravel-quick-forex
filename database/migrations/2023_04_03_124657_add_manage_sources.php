<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManageSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source_name');
            $table->string('tcs_rate');
            $table->bigInteger('exempt');
            $table->text('documents')->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::table('manage_sources', function (Blueprint $table) {
            Schema::dropIfExists('manage_sources');
        });
    }
}

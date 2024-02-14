<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagePurposes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_purposes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purpose_name');
            $table->string('purpose_code');
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
        Schema::table('manage_purposes', function (Blueprint $table) {
            Schema::dropIfExists('manage_purposes');
        });
    }
}

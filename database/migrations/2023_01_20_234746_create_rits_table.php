<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rits', function (Blueprint $table) {
            $table->id();
            $table->string('barcode_antrian')->unique();
            $table->string('spta')->nullable();
            $table->string('register')->nullable();
            $table->string('nopol')->nullable();
            $table->string('kud')->nullable();
            $table->string('pos')->nullable();
            $table->string('wilayah')->nullable();
            $table->string('petani')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rits');
    }
}

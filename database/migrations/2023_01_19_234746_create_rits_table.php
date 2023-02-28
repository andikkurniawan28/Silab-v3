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
            $table->foreignId('kud_id')->constrained()->nullable();
            $table->foreignId('pospantau_id')->constrained()->nullable();
            $table->foreignId('wilayah_id')->constrained()->nullable();
            $table->string('category');
            $table->string('spta')->unique();
            $table->string('rfid')->nullable();
            $table->string('barcode_antrian')->nullable()->unique();
            $table->string('register')->nullable();
            $table->string('nopol')->nullable();
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

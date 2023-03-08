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
            $table->string('category');
            $table->string('spta')->unique();
            $table->string('rfid')->nullable();
            $table->string('barcode_antrian')->nullable()->unique();
            $table->string('register')->nullable();
            $table->string('nopol')->nullable();
            $table->string('petani')->nullable();
            $table->foreignId('posbrix_id')->nullable()->constrained();
            $table->foreignId('kud_id')->nullable()->constrained();
            $table->foreignId('pospantau_id')->nullable()->constrained();
            $table->foreignId('wilayah_id')->nullable()->constrained();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAriSamplingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ari_samplings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rit_id')->unique()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('category');
            $table->string('rfid')->nullable();
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
        Schema::dropIfExists('ari_samplings');
    }
}

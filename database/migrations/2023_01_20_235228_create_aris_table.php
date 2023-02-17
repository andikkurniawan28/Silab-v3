<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ari_sampling_id')->constrained()->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('category');
            $table->float('pbrix');
            $table->float('ppol');
            $table->float('pol');
            $table->float('yield');
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
        Schema::dropIfExists('aris');
    }
}

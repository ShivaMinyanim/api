<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinyansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minyanim', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['shacharis', 'mincha', 'mincha/maariv', 'maariv']);
            $table->timestamp('timestamp');
            $table->timestamps();

            $table->unsignedInteger('house_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minyanim');
    }
}

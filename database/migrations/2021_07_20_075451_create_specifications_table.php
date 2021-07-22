<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string('screen');
            $table->string('camera');
            $table->string('camera_selfie');
            $table->string('ram');
            $table->string('internal_memory');
            $table->string('cpu');
            $table->string('gpu');
            $table->string('pin');
            $table->string('sim');
            $table->string('operating_system');
            $table->string('made_in');
            $table->date('release_time');
            $table->text('description');
            $table->foreignId('product_id')->constrained('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}

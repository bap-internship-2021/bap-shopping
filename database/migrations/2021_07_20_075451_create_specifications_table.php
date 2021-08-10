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
            $table->string('screen')->default('50');
            $table->string('camera')->default('--');
            $table->string('camera_selfie')->default('--');
            $table->string('ram')->default('--');
            $table->string('internal_memory')->default('--');
            $table->string('cpu')->default('--');
            $table->string('gpu')->default('--');
            $table->string('pin')->default('--');
            $table->string('sim')->default('--');
            $table->string('operating_system')->default('--');
            $table->string('made_in')->default('--');
            $table->date('release_time')->default(now());
            $table->text('description')->nullable();
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

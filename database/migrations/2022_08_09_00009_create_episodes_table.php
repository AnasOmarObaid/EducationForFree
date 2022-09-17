<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('path')->nullable();
            $table->text('description')->nullable();
            $table->string('type', 50)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('learns')->nullable();
            $table->integer('percent')->default(0);

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
        Schema::dropIfExists('episodes');
    }
};

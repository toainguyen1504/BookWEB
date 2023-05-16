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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('chapter_name');
            $table->tinyInteger('status')->default(0);

            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');

            $table->unsignedBigInteger('read_id');
            $table->foreign('read_id')->references('id')->on('reads');

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
        Schema::dropIfExists('chapters');
    }
};

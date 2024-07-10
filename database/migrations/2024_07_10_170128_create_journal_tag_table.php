<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateJournalTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_tag', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('tag_id')->unsigned();
			$table->bigInteger('journal_id')->unsigned();
            $table->timestamps();

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
            $table->foreign('journal_id')
                ->references('id')
                ->on('journals')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_tag');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheatsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cheats', function (Blueprint $table) {
			$table->increments('id');
			$table->uuid('uuid')->unique();
			$table->index('uuid');

			$table->string('name');
			$table->text('description')->nullable();
			$table->string('code');
			$table->enum('status', ['active', 'inactive'])
				  ->default('active');

			$table->integer('creator_id')->unsigned();
			$table->foreign('creator_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');

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
		Schema::dropIfExists('cheats');
	}
}

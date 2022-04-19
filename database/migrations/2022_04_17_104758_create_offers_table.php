<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agence_id');
            $table->bigInteger('category_id');
            $table->string('address');
            $table->text('description');
            $table->double('price');
            $table->double('space');
            $table->integer('n_etage')->nullable();
            $table->integer('n_chambre')->nullable();
            $table->string('wilaya');
            $table->json('photo')->nullable();

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
        Schema::dropIfExists('offers');
    }
}

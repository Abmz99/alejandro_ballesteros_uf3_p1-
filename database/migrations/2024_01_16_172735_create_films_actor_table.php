<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsActorTable extends Migration
{
    public function up()
    {
        Schema::create('films_actors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('actor_id');
            $table->timestamps();

            // Definir las foreign keys
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade'); 
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('films_actors');
        

    }
}

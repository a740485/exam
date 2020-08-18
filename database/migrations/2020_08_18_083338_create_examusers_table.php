<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examusers', function (Blueprint $table) {
            $table->string('Account', 50)->unique();
            $table->string('Password', 50);
            $table->timestamps();
            $table->primary(['Account', 'Password']);
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examusers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationEntriesTable extends Migration
{
    /**
     * Run the migrations to create the demo information table.
     */
    public function up()
    {
        Schema::create('information_entries', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations by dropping the table.
     */
    public function down()
    {
        Schema::dropIfExists('information_entries');
    }
}

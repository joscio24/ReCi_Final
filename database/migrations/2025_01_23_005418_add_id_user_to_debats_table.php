<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdUserToDebatsTable extends Migration
{
    public function up()
    {
        Schema::table('debats', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->nullable(); // Add the id_user column
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // Add foreign key
        });
    }

    public function down()
    {
        Schema::table('debats', function (Blueprint $table) {
            $table->dropForeign(['id_user']); // Drop foreign key
            $table->dropColumn('id_user');   // Drop column
        });
    }
}

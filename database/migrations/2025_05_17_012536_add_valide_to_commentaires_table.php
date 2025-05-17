<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('commentaires', function (Blueprint $table) {
        $table->boolean('valide')->default(false)->after('choix'); // ou après un autre champ pertinent
    });
}

public function down()
{
    Schema::table('commentaires', function (Blueprint $table) {
        $table->dropColumn('valide');
    });
}

};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id('id_commentaire');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_debat');
            $table->unsignedBigInteger('id_vote')->nullable();
            $table->text('texte');
            $table->dateTime('date_commentaire');
            $table->unsignedBigInteger('id_parent_commentaire')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_debat')->references('id_debat')->on('debats')->onDelete('cascade');
            $table->foreign('id_vote')->references('id_vote')->on('votes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};

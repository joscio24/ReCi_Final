<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commentaire_id')->references('id_commentaire')->on('commentaires')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Ensure a user can only like a comment once
            $table->unique(['commentaire_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
};

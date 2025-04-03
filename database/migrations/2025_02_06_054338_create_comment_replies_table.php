<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->references('id_commentaire')->on('commentaires')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('reply_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_replies');
    }
};


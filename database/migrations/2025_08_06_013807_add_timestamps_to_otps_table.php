<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToOtpsTable extends Migration
{
    public function up()
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->timestamps();  // adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}

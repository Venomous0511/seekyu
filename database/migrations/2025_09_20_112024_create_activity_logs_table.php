<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id(); // ACT id as autoincrement
            $table->string('log_id')->unique(); // optional custom like ACT-0001
            $table->timestamp('time_iso')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->string('type')->nullable();
            $table->string('source')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
};

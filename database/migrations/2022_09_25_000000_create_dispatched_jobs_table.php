<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispached_jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('job');
            $table->enum('status', ['criado', 'processando', 'sucesso', 'falha']);
            $table->longText('response')->nullable();
            $table->timestamp('started_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispached_jobs');
    }
};

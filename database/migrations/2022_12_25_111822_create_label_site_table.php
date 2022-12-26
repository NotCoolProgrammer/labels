<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('label_site', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')
                ->constrained('sites')
                ->cascadeOnDelete();
            $table->foreignId('label_id')
                ->constrained('labels')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('label_site');
    }
};

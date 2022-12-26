<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('label_company', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();
            $table->foreignId('label_id')
                ->constrained('labels')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('label_company');
    }
};

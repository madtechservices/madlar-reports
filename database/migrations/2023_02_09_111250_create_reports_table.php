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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->nullable();
            $table->string('report_name')->nullable();
            $table->enum('type',['table','chart','widget']);
            $table->integer('sort');
            $table->string('table_name')->nullable();
            $table->json('joins')->nullable();
            $table->json('conditions')->nullable();
            $table->json('aggregate')->nullable();
            $table->json('fields')->nullable();
            $table->bigInteger('rows_count')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('reports');
    }
};

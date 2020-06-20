<?php

use Illuminate\Support\Facades\{Schema, DB};
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'Innodb';
            $table->unsignedTinyInteger('id', true);
            $table->string('label_name', 50)->nullable(false)->default('')->comment('标签名');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `labels` comment '文章标签表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels');
    }
}

<?php

use Illuminate\Support\Facades\{Schema, DB};
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'Innodb';
            $table->unsignedTinyInteger('id', true);
            $table->unsignedTinyInteger('pid')->nullable(false)->default(0)->comment('父级分类id');
            $table->string('cate_name', 50)->unique()->nullable(false)->default('')->comment('分类名');
            $table->string('keywords', 100)->nullable(false)->default('')->comment('关键字');
            $table->string('description', 255)->nullable(false)->default('')->comment('描述');
            $table->unsignedTinyInteger('status')->nullable(false)->default(1)->comment('状态：0隐藏，1展示');
            $table->unsignedTinyInteger('sort')->nullable(false)->default(0)->comment('排序');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `categories` comment '文章分类表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

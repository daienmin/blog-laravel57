<?php

use Illuminate\Support\Facades\{Schema, DB};
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'Innodb';
            $table->increments('id');
            $table->unsignedTinyInteger('cate_id')->nullable(false)->default(0)
                ->comment('分类ID')->index();
            $table->unsignedTinyInteger('label_id')->nullable(false)->default(0)
                ->comment('标签ID')->index();
            $table->unsignedInteger('u_id')->nullable(false)->default(0)->comment('作者');
            $table->string('title', 100)->nullable(false)->default('')
                ->comment('文章标题')->index();
            $table->string('keywords', 100)->nullable(false)->default('')->comment('关键字');
            $table->string('description', 255)->nullable(false)->default('')->comment('描述');
            $table->text('content')->comment('内容');
            $table->string('img_url', 255)->nullable(false)->default('')->comment('文章图片');
            $table->unsignedInteger('recommend')->nullable(false)->default(0)->comment('推荐：0否，1是');
            $table->unsignedSmallInteger('views')->nullable(false)->default(0)->comment('访问次数');
            $table->unsignedTinyInteger('status')->nullable(false)->default(1)->comment('状态：0未发布，1已发布');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `articles` comment '文章表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

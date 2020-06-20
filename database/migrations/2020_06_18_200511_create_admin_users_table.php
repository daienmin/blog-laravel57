<?php

use Illuminate\Support\Facades\{Schema,DB};
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->charset = "utf8";
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->string('username', 30)->nullable(false)->default('')->unique()
                ->comment('用户名');
            $table->string('password', 255)->nullable(false)->default('')
                ->comment('密码');
            $table->unsignedTinyInteger('role_id')->nullable(false)->default(0)
                ->comment('角色id');
            $table->unsignedTinyInteger('status')->nullable(false)->default(1)
                ->comment('用户状态：0禁用，1启用');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_users` comment '后台用户表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
